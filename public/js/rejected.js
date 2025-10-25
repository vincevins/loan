async function getData() {
  const url =
    "http://localhost/casestudy-loan/loan/controller/getapplication.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const result = await response.json();
    const applicationForm = result.find(
      (item) =>
        item.application_status === "rejected" ||
        item.application_status_for_admin === "rejected"
    );
    const list = [applicationForm];
    const ListContainer = document.querySelector(".listApprove");
    ListContainer.innerHTML = "";
    list.forEach((data) => {
      const tblRow = document.createElement("tr");
      const id = document.createElement("td");
      id.textContent = data.loanID;
      const fName = document.createElement("td");
      fName.textContent = data.last_name + "," + data.first_name;
      const amount = document.createElement("td");
      amount.textContent = data.loan_amount;
      const application_status = document.createElement("td");
      application_status.textContent = data.application_status;
      const dateApplied = document.createElement("td");
      dateApplied.textContent = data.created_at;
      const reviewer = document.createElement("td");
      reviewer.textContent = data.assigned_hr;
      const reviewDate = document.createElement("td");
      reviewDate.textContent = data.hr_approval_date;
      const remarks = document.createElement("td");
      remarks.textContent = data.remarks;
      tblRow.append(
        id,
        fName,
        amount,
        application_status,
        dateApplied,
        reviewer,
        reviewDate,
        remarks,
      );
      ListContainer.appendChild(tblRow);
    });
  } catch (error) {
    console.error(error.message);
  }
}
document.getElementById("exportExcel").addEventListener("click", function () {
  const table = document.getElementById("reject");
  const rows = table.querySelectorAll("tr");
  let csvContent = "";

  rows.forEach((row) => {
    const cols = row.querySelectorAll("th, td");
    let rowData = [];
    cols.forEach((col) => {
      let cellText = col.textContent.replace(/"/g, '""');
      rowData.push(`"${cellText}"`);
    });
    csvContent += rowData.join(",") + "\n";
  });

  const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
  const url = URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url;
  a.download = "reject.csv";
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
});
document.getElementById("exportPdf").addEventListener("click", async () => {
  const { jsPDF } = window.jspdf;
  const table = document.getElementById("reject");
  const canvas = await html2canvas(table, { scale: 2 });
  const imgData = canvas.toDataURL("image/png");

  const pdf = new jsPDF("p", "mm", "a4");
  const pdfWidth = pdf.internal.pageSize.getWidth();
  const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

  pdf.addImage(imgData, "PNG", 0, 10, pdfWidth, pdfHeight);
  pdf.save("reject.pdf");
});
getData();
setInterval(() => {
  getData();
}, 5000);
