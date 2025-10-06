const totalActive = document.getElementById("totalActive");
const pendingApplication = document.getElementById("pendingApplication");
const approvedApplication = document.getElementById("approvedApplication");
const revenue = document.getElementById("revenue");

async function dataCards() {
  const url ="http://localhost/casestudy-loan/loan/controller/adminDashboard.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const result = await response.json();
    totalActive.textContent = result.active.count;
    pendingApplication.textContent = result.pending.pending;
    approvedApplication.textContent = result.approved.approved;
    console.log(result);
  } catch (error) {
    console.error(error.message);
  }
}
dataCards();
