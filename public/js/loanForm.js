const session = document.getElementById("sessionLoan");
const sessionEl = session.dataset.sessionStatus;
console.log("data: ", sessionEl);
const hasLoan = document.getElementById("hasLoan");
const applicationform = document.getElementById("application-form");
if (sessionEl === "1") {
  hasLoan.style.display = "block";
  applicationform.style.display = "none";
}
function capitalizeFirstLetter(str) {
  if (str.length === 0) {
    return "";
  }
  return str.charAt(0).toUpperCase() + str.slice(1);
}

async function getApplication() {
  const step2Review = document.getElementById("step2Review");
  const step2Approved = document.getElementById("step2Approved");
  const step3Review = document.getElementById("step3Review");
  const step4Review = document.getElementById("step4Review");
  const step3Approved = document.getElementById("step3Approved");
  const step4Approved = document.getElementById("step4Approved");
  const step4Txt = document.getElementById("step4Txt");
  const submittedDate = document.getElementById("submittedDate");
  const hrverifyStatus = document.getElementById("hrverifyStatus");
  const verifyStatus = document.getElementById("verifyStatus");
  const url = "http://localhost/casestudy-loan/loan/controller/application.php";
  try {
    const res = await fetch(url);
    if (!res.ok) {
      throw new Error(`Response status: ${res.status}`);
    }
    const result = await res.json();
    const date = new Date(result[0].created_at);
    const options = { month: "long", day: "numeric", year: "numeric" };
    const formalDate = date.toLocaleDateString("en-US", options);
    submittedDate.textContent = formalDate;
    const hrApproval = result[0].application_status;
    const adminApproval = result[0].application_status_for_admin;
    console.log(hrApproval);
    if (hrApproval.trim().toLowerCase() === "approved") {
      step2Approved.style.display = "flex";
      step2Review.style.display = "none";
      const txtApproval = capitalizeFirstLetter(hrApproval);
      hrverifyStatus.textContent = txtApproval;
    }
    if (adminApproval.trim().toLowerCase() === "approved") {
      step3Review.style.display = "none";
      step3Approved.style.display = "flex";
      const txtAdmin = capitalizeFirstLetter(adminApproval);
      verifyStatus.textContent = txtAdmin;
    }
    if (
      adminApproval.trim().toLowerCase() === "approved" &&
      hrApproval.trim().toLowerCase() === "approved"
    ) {
      step4Approved.style.display = "flex";
      step4Review.style.display = "none";
      step4Txt.textContent = "Approved";
    }
    console.log("Data: ", result);
  } catch (error) {
    console.error(error.message);
    alert("Something went wrong: " + error.message);
  }
}
getApplication();

