$(document).ready(function () {
    $("#excelFile").on("change", function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (event) {
            const data = new Uint8Array(event.target.result);
            const workbook = XLSX.read(data, { type: "array" });

            const sheetName = workbook.SheetNames[0];
            const sheet = workbook.Sheets[sheetName];
            const jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

            let tableHtml = "";
            jsonData.forEach(row => {
                tableHtml += "<tr>";
                row.forEach(cell => {
                    tableHtml += `<td>${cell !== undefined ? cell : ""}</td>`;
                });
                tableHtml += "</tr>";
            });

            $("#excelData").html(tableHtml);
        };

        reader.readAsArrayBuffer(file);
    });
});