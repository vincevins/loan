fetch("http://localhost/casestudy-loan/loan/controller/paymentSchedule.php")
  .then((response) => response.json())
  .then((data) => {
    console.log("Fetched:", data);
    const totalLoanAmountSched = document.getElementById(
      "totalLoanAmountSched"
    );
    const remainingBalanceSched = document.getElementById(
      "remainingBalanceSched"
    );
    const nextPaymentDateSched = document.getElementById(
      "nextPaymentDateSched"
    );
    const nextPaymentAmountSched = document.getElementById(
      "nextPaymentAmountSched"
    );

    if (data[11].payment_status === "paid") {
      totalLoanAmountSched.textContent = "₱ 0.00";
    } else {
      totalLoanAmountSched.textContent =
        "₱" + Number(data[0].beginning_balance).toLocaleString();
    }
    let dis = null;
    for (let j = 0; j < data.length; j++) {
      if (data[j].payment_status !== "paid") {
        dis = data[j];
        break;
      }
    }
    remainingBalanceSched.textContent =
      "₱" + Number(dis.beginning_balance).toLocaleString();
    var date = new Date(dis.due_date);
    let dateFormatter = date.toDateString();
    nextPaymentDateSched.textContent = dateFormatter;
    nextPaymentAmountSched.textContent =
      "₱" + Number(dis.total_payment_due).toLocaleString();

    const totalAmmount = document.getElementById("totalLoanAmount");
    const remaining = document.getElementById("remainingBalance");
    const nextDue = document.getElementById("nextPaymentDate");
    const nextPayment = document.getElementById("nextPaymentAmount");

    if (data[11].payment_status === "paid") {
      totalAmmount.textContent = "₱ 0.00";
    } else {
      totalAmmount.textContent =
        "₱" + Number(data[0].beginning_balance).toLocaleString();
    }
    let display = null;
    for (let index = 0; index < data.length; index++) {
      if (data[index].payment_status !== "paid") {
        display = data[index];
        break;
      }
    }
    remaining.textContent =
      "₱" + Number(display.beginning_balance).toLocaleString();
    var date = new Date(display.due_date);
    let dateFormat = date.toDateString();
    nextDue.textContent = dateFormat;
    nextPayment.textContent =
      "₱" + Number(display.total_payment_due).toLocaleString();

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
      tblRow.append( id,duedate,paymentdue,no_interest,total_interest,status);
      ListContainer.appendChild(tblRow);
    });
  })
  .catch((error) => {
    console.error("Error fetching data:", error);
  });


  const btnPaymentSched = document.getElementById("btnPaymentSched");
  const btnPersonalInfo = document.getElementById("btnPersonalInformation");
  const personalInfoModal = document.getElementById("personalInfoModal");
  const paymentSchedModal = document.getElementById("paymentSchedModal");

  btnPersonalInfo.addEventListener("click", () => {
    personalInfoModal.style.display = "block";
     paymentSchedModal.style.display = "none";
    

  });
  btnPaymentSched.addEventListener("click", () => {
    personalInfoModal.style.display = "none";
    paymentSchedModal.style.display = "block";
    

  });


