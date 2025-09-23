fetch("http://localhost/casestudy-loan/loan/controller/paymentSchedule.php")
  .then((response) => response.json())
  .then((data) => {
    console.log("Fetched:", data);

    const ListContainer = document.querySelector(".paymentScheduleBody");
    ListContainer.innerHTML = "";
    data.forEach((item, index) => {
      const tblRow = document.createElement("tr");
      const id = document.createElement("td");
      id.textContent = index + 1;
      const duedate = document.createElement("td");
      duedate.textContent = item.due_date;
      const paymentdue = document.createElement("td");
      paymentdue.textContent = item.total_payment_due;
      const no_interest = document.createElement("td");
      no_interest.textContent = item.monthly_payment_no_interest;
      const total_interest = document.createElement("td");
      total_interest.textContent = item.interest;
       const status = document.createElement("td");
      status.textContent = item.payment_status;
      
      tblRow.append(id, duedate, paymentdue, no_interest, total_interest,status);
      ListContainer.appendChild(tblRow);
    });
  })
  .catch((error) => {
    console.error("Error fetching data:", error);
  });
