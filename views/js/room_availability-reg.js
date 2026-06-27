$(document).ready(function () {
  let roomChoice;

  const DAYS        = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  const DEFAULT_START = '07:30';
  const DEFAULT_END   = '19:00';

  loadRoom();

  $('#back').click(function () { window.location.href = 'teacher-availability'; });
  $('#next').click(function () { window.location.href = 'schedule'; });

  $('#addAvailability').click(function () {
      addAvailabilityRow();
  });

  $(document).on('click', '.remove-availability', function () {
      $(this).closest('.availability-item').remove();
  });

  $('#submitAvailability').click(function () {
      const roomID = $('#room')[0].value;

      if (!roomID) {
          Swal.fire({ icon: 'warning', title: 'No Room Selected', text: 'Please select a room.', confirmButtonText: 'OK' });
          return;
      }

      let windows = [];
      let valid   = true;

      $('.availability-item').each(function () {
          const day   = $(this).find('.day-select')[0].value;
          const start = $(this).find('.time-start').val();
          const end   = $(this).find('.time-end').val();

          if (!day || !start || !end) {
              valid = false;
              return false;
          }

          if (start >= end) {
              Swal.fire({ icon: 'warning', title: 'Invalid Time', text: `Start time must be before end time on ${day}.`, confirmButtonText: 'OK' });
              valid = false;
              return false;
          }

          windows.push({ day, start, end });
      });

      if (!valid) return;

      if (windows.length === 0) {
          Swal.fire({ icon: 'warning', title: 'No Availability Set', text: 'Please add at least one availability window.', confirmButtonText: 'OK' });
          return;
      }

      saveAvailability(roomID, windows);
  });

  function addAvailabilityRow(day = '', start = DEFAULT_START, end = DEFAULT_END) {
      const dayOptions = DAYS.map(d =>
          `<option value="${d}" ${d === day ? 'selected' : ''}>${d}</option>`
      ).join('');

      const row = `
      <div class="availability-item mb-3">
          <div class="row g-3 align-items-end">
              <div class="col-md-4">
                  <label class="form-label">Day <span class="text-danger">*</span></label>
                  <select class="form-select day-select">
                      ${dayOptions}
                  </select>
              </div>
              <div class="col-md-3">
                  <label class="form-label">Start Time <span class="text-danger">*</span></label>
                  <input type="time" class="form-control time-start" value="${start}" min="07:30" max="19:00">
              </div>
              <div class="col-md-3">
                  <label class="form-label">End Time <span class="text-danger">*</span></label>
                  <input type="time" class="form-control time-end" value="${end}" min="07:30" max="19:00">
              </div>
              <div class="col-md-2 d-flex">
                  <button class="btn w-100 btn-outline-danger remove-availability d-flex justify-content-center align-items-center" type="button">
                      <i class="ri-close-line"></i>
                  </button>
              </div>
          </div>
      </div>`;

      $('#availabilityList').append(row);
  }

  function loadRoom() {
      $.ajax({
          url: 'ajax/room-list.ajax.php',
          method: 'POST',
          dataType: 'json',
          success: function (response) {
              let options = response.map(r =>
                  `<option value="${r.roomID}">${r.roomNum}</option>`
              ).join('');

              $('#room').html(options);

              if (roomChoice) roomChoice.destroy();
              roomChoice = new Choices('#room', {
                  placeholderValue: 'Select a room',
                  searchPlaceholderValue: 'Search...',
                  itemSelectText: '',
              });
          }
      });
  }

  function saveAvailability(roomID, windows) {
      (async () => {
          try {
              await clearAvailability(roomID);

              for (const w of windows) {
                  const result = await postAvailability(roomID, w);
                  if (result !== 'success') throw new Error(result);
              }

              Swal.fire({
                  icon: 'success',
                  title: 'Availability Saved',
                  text: 'Room availability has been successfully saved.',
                  confirmButtonText: 'OK'
              }).then(() => {
                  window.location.reload();
              });

          } catch (err) {
              Swal.fire({ icon: 'error', title: 'Failed', text: err.message, confirmButtonText: 'OK' });
          }
      })();
  }

  function clearAvailability(roomID) {
      return new Promise((resolve, reject) => {
          $.ajax({
              url: 'ajax/room-availability-clear.ajax.php',
              method: 'POST',
              data: { roomID },
              dataType: 'text',
              success: resolve,
              error: () => reject(new Error('Failed to clear existing availability.'))
          });
      });
  }

  function postAvailability(roomID, w) {
      let formData = new FormData();
      formData.append('roomID',    roomID);
      formData.append('dayOfWeek', w.day);
      formData.append('timeStart', w.start);
      formData.append('timeEnd',   w.end);

      return new Promise((resolve, reject) => {
          $.ajax({
              url: 'ajax/room-availability-reg.ajax.php',
              method: 'POST',
              cache: false,
              data: formData,
              dataType: 'text',
              processData: false,
              contentType: false,
              success: resolve,
              error: () => reject(new Error('AJAX error saving room availability.'))
          });
      });
  }
});