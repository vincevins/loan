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
  const submittedDate = document.getElementById("submittedDate");
  const hrverifyStatus = document.getElementById("hrverifyStatus");
  const verifyStatus = document.getElementById("verifyStatus");
  const applicationStatus = document.getElementById("applicationStatus");

  async function getApplication() {
    const url =
      "http://localhost/casestudy-loan/loan/controller/application.php";
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
      console.log(hrApproval);

      if (hrApproval.trim().toLowerCase() === "approved") {
        const txtApproval = capitalizeFirstLetter(hrApproval);
        hrverifyStatus.textContent = txtApproval;
      }

      console.log("Data: ", result);
    } catch (error) {
      console.error(error.message);
      alert("Something went wrong: " + error.message);
    }
  }
  getApplication();

