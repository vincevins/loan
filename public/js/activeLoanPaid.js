const modalActivePaid = document.getElementById('modalActivePaid')
const paymentamount = document.getElementById('payment-amount')
const datepayment = document.getElementById('date-payment')
const withoutinterest = document.getElementById('without-interest')
const interestpaid = document.getElementById('interest-paid')
const refpayment = document.getElementById('ref-payment')
var span = modalActivePaid.querySelector(".closeBTN");
async function getPaid() {
    const url = "http://localhost/casestudy-loan/loan/controller/paymentActive.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        const active = result.filter(item => item.hasLoan === 1);
        const ListContainer = document.querySelector(".listPaid");
        ListContainer.innerHTML = ""; 
        active.forEach((data) => {
        const paymentdate = new Date(data.payment_date.replace(' ', 'T'));
        const formattedDatepay = paymentdate.toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        });
        const dueDate = new Date(data.due_date.replace(' ', 'T'));
        const formattedDate = dueDate.toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        });
        const tblRow = document.createElement("tr");
        const id = document.createElement("td");
        id.textContent = data.loanID
        const fName = document.createElement("td");
        fName.textContent = data.last_name+ ', ' + data.first_name
        const amount = document.createElement("td");
        amount.textContent = '₱' + data.payment_amount
        const payment_date = document.createElement("td")
        payment_date.textContent = formattedDate
        const days_overdue = document.createElement("td")
        days_overdue.textContent = formattedDatepay
        const payment_status = document.createElement("td");
        payment_status.textContent = data.payment_status;
        const action = document.createElement("td");
        action.innerHTML = `<button class="view-btn" data-id="${data.id}"><i class='far fa-eye'></i></button>`;
        tblRow.append(id, fName,amount,payment_date,days_overdue,payment_status,action);
        ListContainer.appendChild(tblRow);
        });
        
    } catch (error) {
        console.error(error.message);
    }
}
document.addEventListener("click", async function (e) {
  const viewButton = e.target.closest(".view-btn");

  if (!viewButton) return;
  const id = viewButton.getAttribute("data-id");
  if (!id) {
    console.error("No data-id found.");
    return;
  }
  modalActivePaid.style.display = "flex";
  const url = "http://localhost/casestudy-loan/loan/controller/viewActivePaid.php";
  try {
    const formData = new FormData();
    formData.append("id", id);
    const response = await fetch(url, {
      method: "POST",
      body: formData,
    });

    if (!response.ok) {
      throw new Error(`HTTP error: ${response.status}`);
    }
    const res = await response.json();
    const list = res[0]
    paymentamount.textContent = "₱ " + list.payment_amount
    datepayment.textContent = list.payment_date
    withoutinterest.textContent = list.monthly_payment_no_interest
    interestpaid.textContent = list.interest_paid
    refpayment.textContent = list.payment_reference
  } catch (error) {
    console.error("Fetch error:", error.message);
  }
});
span.addEventListener('click', function(){
    modalActivePaid.style.display = 'none'
})
document.getElementById('exportExcel').addEventListener('click', function () {
    const table = document.getElementById('paid');
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
    a.download = 'active_loan_payment.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});
document.getElementById("exportPdf").addEventListener("click", async () => {
      const { jsPDF } = window.jspdf;
      const table = document.getElementById("paid");
      const canvas = await html2canvas(table, { scale: 2 });
      const imgData = canvas.toDataURL("image/png");

      const pdf = new jsPDF("p", "mm", "a4");
      const pdfWidth = pdf.internal.pageSize.getWidth();
      const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

      pdf.addImage(imgData, "PNG", 0, 10, pdfWidth, pdfHeight);
      pdf.save("payment_history.pdf");
    });
getPaid()
setInterval(() => {
  getPaid();
}, 5000);