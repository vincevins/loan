fetch("http://localhost/casestudy-loan/loan/controller/getapplication.php")
  .then((response) => response.json())
  .then((data) => {
    console.log("Fetched:", data);
    const ListContainer = document.querySelector(".list tbody");
    ListContainer.innerHTML = "";
    data.forEach((item, index) => {
      const tblRow = document.createElement("tr");
      const id = document.createElement("td");
      id.textContent = index + 1;
      const firstName = document.createElement("td");
      firstName.textContent = item.first_name;
      const lastName = document.createElement("td");
      lastName.textContent = item.last_name;
      const application_status = document.createElement("td");
      application_status.textContent = item.application_status;
      const approveBtn = document.createElement("td");
      approveBtn.innerHTML = `<button class="approve-btn" data-id="${item.id}">APPROVE</button>`;

      tblRow.append(id, firstName, lastName, application_status, approveBtn);
      ListContainer.appendChild(tblRow);
    });
  })
  .catch((error) => {
    console.error("Error fetching data:", error);
  });


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
      alert(result.message || "Application approved successfully!");
    } catch (error) {
      console.error(error.message);
      alert("Something went wrong: " + error.message);
    }
  }
});
