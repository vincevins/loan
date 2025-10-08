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
    console.log(result);
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
    console.log(result);
  } catch (error) {
    console.error(error.message);
  }
}
async function getData() {
  const container = document.getElementById("paymentList");
  const url = "http://localhost/casestudy-loan/loan/controller/adminDashboardCards.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const result = await response.json();
    const payments = result
    updateStatus();
    console.log('test data: ', payments);
    if (payments.length === 0) {
      container.innerHTML = `<div class="empty-state">
      <i class="fas fa-credit-card"></i>
      <p>No recent payments</p>
      </div>`;
      return;
    }
    container.innerHTML = payments.map((payment) => {
    const date = new Date(payment.created_at);
    const dateFormat = date.toDateString();
    return `<div class="data-item">
        <div class="data-item-icon payment-icon">
          <span>₱</span>
        </div>
        <div class="data-item-content">
          <p class="data-item-title">${payment.student_no}</p>
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
getData();
dataCards();
