var modalView = document.getElementById("modalView");
var span = document.getElementsByClassName("close")[0];

document.addEventListener("click", async function (e) {
  const fullName = document.getElementById("fullName");
  const detailEmail = document.getElementById("detailEmail");
  const detailPhone = document.getElementById("detailPhone");
  const detailAddress = document.getElementById("detailAddress");
  const idImageFront = document.getElementById("idImageFront");
  const idImageBack = document.getElementById("idImageBack");
  const idSelfie = document.getElementById("idSelfie");
  const proofIncome = document.getElementById("proofIncome");
  
  const viewButton = e.target.closest(".view-btn");
 
  if (!viewButton) return;
  const id = viewButton.getAttribute("data-id");
  if (!id) {
    console.error("No data-id found.");
    return;
  }
  modalView.style.display = "flex";
  const url ="http://localhost/casestudy-loan/loan/controller/getInformaionDocu.php";
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
    const list = result
    const applicationForm = list.filter((item) => item.application_status_for_admin === "under_review");
    const applicant = applicationForm[0];
    fullName.textContent = applicant.last_name + ", " +applicant.first_name
    detailEmail.textContent = applicant.email
    detailPhone.textContent = applicant.contact_no
    detailAddress.textContent = applicant.address
    idImageFront.src = "/casestudy-loan/loan/public/" + applicant.valid_id_front; 
    idImageBack.src = "/casestudy-loan/loan/public/" + applicant.valid_id_back; 
    idSelfie.src = "/casestudy-loan/loan/public/" + applicant.selfie_id; 
    proofIncome.src = "/casestudy-loan/loan/public/" + applicant.proof_income; 
    console.log("testt", applicant.valid_id_front);
  } catch (error) {
    console.error("Fetch error:", error.message);
  }
});

span.onclick = function () {
  modalView.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modalView) {
    modalView.style.display = "none";
  }
};
