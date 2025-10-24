document.addEventListener("DOMContentLoaded", function() {
const modalView = document.getElementById("modalViewApproved");
var span = modalView.querySelector(".btnClose");
const fullName = document.getElementById("AfullName");
const detailEmail = document.getElementById("detail-email");
const detailPhone = document.getElementById("detail-phone");
const detailAddress = document.getElementById("detail-address");
const idImageFront = document.getElementById("id-ImageFront");
const idImageBack = document.getElementById("id-ImageBack");
const idSelfie = document.getElementById("id-Selfie");
const proofIncome = document.getElementById("proof-Income");
const detailAnnualincome = document.getElementById("detail-Annualincome");
const detailLoanAmount = document.getElementById("detail-LoanAmount");
const detailPurpose = document.getElementById("detail-Purpose");
const detailLoanTerm = document.getElementById("detail-LoanTerm");
document.getElementById("exportPdf").addEventListener("click", async () => {
      const { jsPDF } = window.jspdf;
      const table = document.getElementById("approved");
      const canvas = await html2canvas(table, { scale: 2 });
      const imgData = canvas.toDataURL("image/png");

      const pdf = new jsPDF("p", "mm", "a4");
      const pdfWidth = pdf.internal.pageSize.getWidth();
      const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

      pdf.addImage(imgData, "PNG", 0, 10, pdfWidth, pdfHeight);
      pdf.save("approved.pdf");
    });
document.getElementById('exportExcel').addEventListener('click', function () {
    const table = document.getElementById('approved');
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
    a.download = 'approved_application.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});

async function getData() {
    const url = 'http://localhost/casestudy-loan/loan/controller/getapplication.php'
    try {
        const response = await fetch(url);
        if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        const applicationForm = result.filter(item => item.application_status === 'approved' && item.application_status_for_admin === 'approved');
        const ListContainer = document.querySelector(".listApprove");
        ListContainer.innerHTML = "";
        applicationForm.forEach((data) => {
        const dueDate = new Date(data.created_at.replace(' ', 'T'));
        const formattedDate = dueDate.toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        });
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
        dateApplied.textContent = formattedDate
        const reviewer = document.createElement("td")
        reviewer.textContent = data.assigned_hr
        const reviewDate = document.createElement("td")
        reviewDate.textContent = data.hr_approval_date 
        const remarks = document.createElement("td")
        remarks.textContent = data.remarks       
        const action = document.createElement("td");
        action.innerHTML = `<button class="view-btn" data-id="${data.id}"><i class='far fa-eye'></i></button>`;
        tblRow.append(id, fName,amount,application_status,dateApplied,reviewer,reviewDate,remarks,action);
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
  modalView.style.display = "flex";
  const url = "http://localhost/casestudy-loan/loan/controller/getInformaionDocu.php";
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
    const result = await response.json();
    const applicationForm = result.filter((item) => item.application_status_for_admin === "approved");

    const applicant = applicationForm[0];
    fullName.textContent = applicant.last_name + ", " + applicant.first_name;
    detailEmail.textContent = applicant.email;
    detailPhone.textContent = applicant.contact_no;
    detailAddress.textContent = applicant.address;
    detailAnnualincome.textContent = applicant.annual_income;
    detailLoanAmount.textContent = applicant.loan_amount;
    detailPurpose.textContent = applicant.loan_purpose;
    detailLoanTerm.textContent = applicant.loan_term;

    idImageFront.src ="/casestudy-loan/loan/public/" + applicant.valid_id_front;
    idImageBack.src = "/casestudy-loan/loan/public/" + applicant.valid_id_back;
    idSelfie.src = "/casestudy-loan/loan/public/" + applicant.selfie_id;
    proofIncome.src = "/casestudy-loan/loan/public/" + applicant.proof_income;
  } catch (error) {
    console.error("Fetch error:", error.message);
  }
});
  span.onclick = function() {
    modalView.style.display = "none";
  };

window.onclick = function (event) {
  if (event.target == modalView) {
    modalView.style.display = "none";
  }
};

 getData();
setInterval(() => {
  getData();
}, 5000);
});