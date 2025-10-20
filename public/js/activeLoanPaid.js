async function getPaid() {
    const url = "http://localhost/casestudy-loan/loan/controller/paymentActive.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        const active = result.filter(item => item.hasLoan === 1);
        console.log(active);
        const ListContainer = document.querySelector(".listPaid");
        ListContainer.innerHTML = "";
        active.forEach((data) => {
        const tblRow = document.createElement("tr");
        const id = document.createElement("td");
        id.textContent = data.loanID
        const fName = document.createElement("td");
        fName.textContent = data.last_name+ ', ' + data.first_name
        const amount = document.createElement("td");
        amount.textContent = '₱' + data.total_payment_due
        const payment_date = document.createElement("td")
        payment_date.textContent = data.payment_date
        const days_overdue = document.createElement("td")
        days_overdue.textContent = data.days_overdue
        const payment_status = document.createElement("td");
        payment_status.textContent = data.payment_status;
        const action = document.createElement("td");
        action.innerHTML = `<button class="view-btn" data-id="${data.id}"><i class='far fa-eye'></i></button>`;
        tblRow.append(id, fName,amount,payment_date,days_overdue,payment_status,action);
        ListContainer.appendChild(tblRow);
        });
        
    } catch (error) {
        console.error(error.message);
    }
}
getPaid()
setInterval(() => {
  getPaid();
}, 5000);