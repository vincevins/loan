document.addEventListener("DOMContentLoaded", () => {
  const hasLoan = document.getElementById("applicationFormStatus");
  const viewApplication = document.getElementById("viewApplication");
  const ApplicationStatus = document.getElementById("ApplicationStatus");
  const ApplicationDetails = document.getElementById("ApplicationDetails");

  viewApplication.addEventListener("click", function () {
    viewApplicationForm();
    ApplicationDetails.style.display = "block";
    hasLoan.style.display = "none";
    viewApplication.style.display = "none";
    ApplicationStatus.style.display = "block";
    console.log("testtttttt");
  });
  ApplicationStatus.addEventListener("click", function () {
    hasLoan.style.display = "block";
    ApplicationDetails.style.display = "none";
    viewApplication.style.display = "block";
    ApplicationStatus.style.display = "none";
  });
  function capitalizeFirstLetter(str) {
    if (str.length === 0) {
      return "";
    }
    return str.charAt(0).toUpperCase() + str.slice(1);
  }
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
      var employment;
      var loan_purpose;
      loan_purpose =  result[0].loan_purpose
      employment = result[0].employment_status
      if (result[0].employment_length === "less_than_1_year") {
        employment_length = "Less than 1 year";
      }
      let html = `<h1 style="text-align:center;">Application Details</h1>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; padding: 20px;">
       <div style="background: rgba(255,255,255,0.2); padding: 12px; border-radius: 6px; margin-top: 12px; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
            <h3 style="font-size: 22px; font-weight: 600; padding-bottom: 10px; color:black;"> Financial Information</h3>
            <div style="background: rgba(255,255,255,0.15); border-radius: 8px;">
                <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Employment:</strong> ${capitalizeFirstLetter(employment)}</p>
                <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Employer Name:</strong> ${fullname}</p>
                <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Employment Length:</strong> ${employment_length}</p>
                <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Annual Income:</strong> ₱ ${result[0].annual_income}</p>
                <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Housing Payment:</strong> ₱ ${result[0].housing_payment}</p>
            </div>
         </div>
         <div style="background: rgba(255,255,255,0.2); padding: 12px; border-radius: 6px; margin-top: 12px; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; ">
            <h3 style="font-size: 22px; font-weight: 600;  padding-bottom: 10px; color:black;"> Loan Details</h3>
            <div style="background: rgba(255,255,255,0.15);  border-radius: 8px;">
                <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Loan Amount:</strong> ₱ ${result[0].loan_amount}</p>
                <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Loan Purpose:</strong> ${capitalizeFirstLetter(loan_purpose)}</p>
                <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Loan Term:</strong> ${result[0].loan_term} months</p>
                <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Interest Rate:</strong> ${result[0].interest_rate}%</p>
                    <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Monthly Payment (No Interest):</strong> ₱ ${result[0].monthly_payment_no_interest}</p>
                    <p style="margin: 8px 0; font-size: 15px; color:black;"><strong>Monthly Payment (With Interest):</strong> <span style="font-size: 18px; color: #1405e6ff;">₱ ${result[0].monthly_payment}</span></p>
                </div>
                </div>
         </div>
      </div>`;
      ApplicationDetails.innerHTML = html;
    } catch (error) {
      console.error(error.message);
      alert("Something went wrong: " + error.message);
    }
  }
});
