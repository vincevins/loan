document.addEventListener("DOMContentLoaded", () => {
  const hasLoan = document.getElementById("applicationFormStatus");
  const viewApplication = document.getElementById("viewApplication");
  const ApplicationStatus = document.getElementById('ApplicationStatus');
  const ApplicationDetails = document.getElementById("ApplicationDetails");

  viewApplication.addEventListener("click", function () {
    viewApplicationForm();
    ApplicationDetails.style.display = "block"
    hasLoan.style.display = "none";
    viewApplication.style.display = "none"
    ApplicationStatus.style.display = "block"
    console.log("testtttttt");
  });
  ApplicationStatus.addEventListener('click', function(){
    hasLoan.style.display = "block";
    ApplicationDetails.style.display = "none"
    viewApplication.style.display = "block"
    ApplicationStatus.style.display = "none"
  });

  async function viewApplicationForm() {
    const url =
      "http://localhost/casestudy-loan/loan/controller/application.php";
    try {
      const res = await fetch(url);
      if (!res.ok) {
        throw new Error(`Response status: ${res.status}`);
      }
      const result = await res.json();
      var fullname = result[0].first_name + " " + result[0].last_name;
      var employment_length;
      if (result[0].employment_length === "less_than_1_year") {
        employment_length = "Less than 1 year";
      }
      let html = `<h4 style="margin: 20px 0 15px;">Financial Information</h4>
        <p><strong>Employment:</strong> ${result[0].employment_status}</p>
        <p><strong>Employer Name:</strong> ${fullname}</p>
        <p><strong>Employment Length:</strong> ${employment_length}</p>
        <p><strong>Annual Income:</strong> ₱ ${result[0].annual_income}</p>
        <p><strong>Housing Payment:</strong> ₱ ${result[0].housing_payment}</p>
        <h4 style="margin: 20px 0 15px;">Loan Details</h4>
        <p><strong>Loan Amount:</strong> ₱ ${result[0].loan_amount}</p>
        <p><strong>Loan Purpose:</strong> ${result[0].loan_purpose}</p>
        <p><strong>Loan Term:</strong> ${result[0].loan_term} months</p>
        <p><strong>Interest Rate:</strong>${result[0].interest_rate}%</p>
        <p><strong>Monthly Payment (No Interest):</strong> ₱ ${result[0].monthly_payment_no_interest} </p>
        <p><strong>Monthly Payment (With Interest):</strong> ₱ ${result[0].monthly_payment}</p>`;
      ApplicationDetails.innerHTML = html;
    } catch (error) {
      console.error(error.message);
      alert("Something went wrong: " + error.message);
    }
  }
});
