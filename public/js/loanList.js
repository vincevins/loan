async function getData() {
    const url = 'http://localhost/casestudy-loan/loan/controller/getActiveLoan.php'
    try {
        const response = await fetch(url);
        if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        const applicationForm = result.filter(item => item.hasLoan === 1);
        const ListContainer = document.querySelector(".list");
        ListContainer.innerHTML = "";
        applicationForm.forEach((data) => {
            const status = data.hasLoan
            var loanStatus;
            if(status === 1){
                loanStatus = 'Active'
            }
            const tblRow = document.createElement("tr");
            const id = document.createElement("td");
            id.textContent = data.loanID
            const fName = document.createElement("td");
            fName.textContent = data.last_name+ ',' + data.first_name
            const amount = document.createElement("td");
            amount.textContent = data.loan_amount
            const application_status = document.createElement("td");
            application_status.textContent = data.application_status;
            const dateApplied = document.createElement("td")
            dateApplied.textContent = data.created_at
            const reviewer = document.createElement("td")
            reviewer.textContent = data.assigned_hr
            const reviewDate = document.createElement("td")
            reviewDate.textContent = data.hr_approval_date 
            const remarks = document.createElement("td")
            remarks.textContent = data.remarks 
            const activeLoan = document.createElement("td")
            activeLoan.textContent = loanStatus
            tblRow.append(id, fName,amount,application_status,dateApplied,reviewer,reviewDate,remarks,activeLoan);
            ListContainer.appendChild(tblRow);
        });
        
    } catch (error) {
        console.error(error.message);
    }
}
document.getElementById('exportExcel').addEventListener('click', function () {
    const table = document.getElementById('loanList');
    const rows = table.querySelectorAll('tr');
    let csvContent = '';

    rows.forEach(row => {
        const cols = row.querySelectorAll('th, td');
        let rowData = [];
        cols.forEach(col => {
            let cellText = col.textContent.replace(/"/g, '""');
            rowData.push(`"${cellText}"`);
        });
        csvContent += rowData.join(',') + '\n';
    });

    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'loanList.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});
document.getElementById("exportPdf").addEventListener("click", async () => {
      const { jsPDF } = window.jspdf;
      const table = document.getElementById("loanList");
      const canvas = await html2canvas(table, { scale: 2 });
      const imgData = canvas.toDataURL("image/png");

      const pdf = new jsPDF("p", "mm", "a4");
      const pdfWidth = pdf.internal.pageSize.getWidth();
      const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

      pdf.addImage(imgData, "PNG", 0, 10, pdfWidth, pdfHeight);
      pdf.save("loanList.pdf");
    });
 getData();
setInterval(() => {
  getData();
}, 5000);
