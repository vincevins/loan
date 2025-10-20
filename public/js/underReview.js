async function getData() {
  const url ="http://localhost/casestudy-loan/loan/controller/getapplication.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const result = await response.json();
    const applicationForm = result.filter((item) => item.application_status_for_admin === "under_review");
    const list = [applicationForm];
    console.log("dataaaa: ", applicationForm);

    const ListContainer = document.querySelector(".list");
    ListContainer.innerHTML = "";
    applicationForm.forEach((data) => {
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
      const action = document.createElement("td");
      action.innerHTML = `<button class="approve-btn" data-id="${data.id}"><i class="fa-solid fa-check"></i></button>
        <button class="reject-btn" data-id="${data.id}"><i class="fas fa-times"></i></button> 
        <button class="view-btn" data-id="${data.id}"> <i class='far fa-eye'></i></button>`
      tblRow.append(id,fName, amount, application_status, dateApplied, reviewer, reviewDate, remarks, action);
      ListContainer.appendChild(tblRow);
    });
  } catch (error) {
    console.error(error.message);
  }
}
function showToast(type, message) {
  const container = document.getElementById("toastContainer");
  const toast = document.createElement("div");
  toast.className = `toast ${type}`;
  let iconClass = "";
  if (type === "success") {
    iconClass = "fa fa-check";
  } else if (type === "error") {
    iconClass = "fa fa-times";
  }
  toast.innerHTML = `<div class="toast-icon">
  <i class="${iconClass}" aria-hidden="true"></i>
  </div>
  <div class="toast-message">${message}</div>
  <button class="toast-close" onclick="closeToast(this)">x</button>`;
  container.appendChild(toast);
  setTimeout(() => {
    closeToast(toast.querySelector(".toast-close"));
  }, 5000);
}
function closeToast(btn) {
  const toast = btn.parentElement;
  toast.classList.add("removing");

  setTimeout(() => {
    toast.remove();
  }, 300);
}
document.addEventListener("click", async function (e) {
  if (e.target.classList.contains("approve-btn")) {
    const id = e.target.getAttribute("data-id");
    const url =
      "http://localhost/casestudy-loan/loan/controller/approveApplication.php";
    try {
      const formData = new FormData();
      formData.append("id", id);
      const response = await fetch(url, {
        method: "POST",
        body: formData,
      });
      const result = await response.json();
      if (!response.ok) {
        throw new Error(response.message || `Error ${response.status}`);
      }
      showToast('success', result.message || "Application approved successfully!") 
      console.log("id:: ", id);
    } catch (error) {
      console.error(error.message);
      alert("Something went wrong: " + error.message);
    }
  }
});
 getData();
setInterval(() => {
  getData();
}, 5000);
