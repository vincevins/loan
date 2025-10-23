const totalActive = document.getElementById("totalActive");
const pendingApplication = document.getElementById("pendingApplication");
const approvedApplication = document.getElementById("approvedApplication");
const revenue = document.getElementById("revenue");

async function dataCards() {
  const url = "http://localhost/casestudy-loan/loan/controller/adminDashboard.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const result = await response.json();
    totalActive.textContent = result.active.count;
    pendingApplication.textContent = result.pending.pending;
    approvedApplication.textContent = result.approved.approved;
    revenue.textContent = result.paid.paid;

  } catch (error) {
    console.error(error.message);
  }
}
async function updateStatus() {
  const url = "http://localhost/casestudy-loan/loan/controller/updateStatusPayment.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const result = await response.json();
 
  } catch (error) {
    console.error(error.message);
  }
}
async function getPayments() {
  const paymentList = document.getElementById("paymentList");
  const url = "http://localhost/casestudy-loan/loan/controller/adminDashboardCards.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const result = await response.json();
    const payments = result
    updateStatus();
    if (payments.length === 0) {
      paymentList.innerHTML = `<div class="empty-state">
      <i class="fas fa-credit-card"></i>
      <p>No recent payments</p>
      </div>`;
      return;
    }
    paymentList.innerHTML = payments.map((payment) => {
    const date = new Date(payment.created_at);
    const dateFormat = date.toDateString();
    return `<div class="data-item">
        <div class="data-item-icon payment-icon">
          <span>₱</span>
        </div>
        <div class="data-item-content">
          <p class="data-item-title">${payment.last_name}, ${payment.first_name} - ${payment.student_no}</p>
          <p class="data-item-subtitle">₱ ${payment.payment_amount} - ${dateFormat}</p>
        </div>
        <span class="data-item-badge">
          ${payment.payment_status.charAt(0).toUpperCase() + payment.payment_status.slice(1)}
        </span>
      </div>`;
  })
  } catch (error) {
    console.error(error.message);
  }
} 
async function getapplication() {
  const applicantList = document.getElementById('applicantList')
  const url = 'http://localhost/casestudy-loan/loan/controller/getapplication.php'
   try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const result = await response.json();
    const applicationForm = result

    const currentDate = new Date();
    const todayApplications = applicationForm.filter(item => {
      if (!item.created_at) return false;
      const createdAtDate = new Date(item.created_at);
      return currentDate.getMonth() === createdAtDate.getMonth() && currentDate.getDate() === createdAtDate.getDate();
    });
    if (todayApplications.length === 0) {
      applicantList.innerHTML = `<div class="empty-state">
        <i class="fa-solid fa-file"></i>
        <p>No Applicant</p>
      </div>`;
      return;
    }else{
      applicantList.innerHTML = todayApplications.map((application) => {
      const date = new Date(application.created_at);
      const dateFormat = date.toDateString();
      return `<div class="data-item">
          <div class="data-item-icon application-icon"> 
            <span>₱</span>
          </div>
          <div class="data-item-content">
            <p class="data-item-title">${application.last_name}, ${application.first_name} - ${application.student_no}</p>
            <p class="data-item-subtitle">₱ ${application.loan_amount} - ${dateFormat}</p>
          </div>
          <span class="data-item-badge">
            ${application.application_status.charAt(0).toUpperCase() + application.application_status.slice(1)}
          </span>
        </div>`;
    })
    } 
  } catch (error) {
    console.error(error.message);
  }
}
  dataCards();
  getPayments();
  getapplication();
setInterval(() => {
  dataCards();
  getPayments();
  getapplication();
}, 5000);
