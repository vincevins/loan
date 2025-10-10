async function getData() {
    const url = "http://localhost/casestudy-loan/loan/controller/adminDashboardCards.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        console.log('test data:', result);
        const ListContainer = document.querySelector(".listApprove");
        ListContainer.innerHTML = "";
        result.forEach((data) => {
        const tblRow = document.createElement("tr");
        const paymentID = document.createElement("td");
        paymentID.textContent = data.payment_id
        const id = document.createElement("td");
        id.textContent = data.loanID
        const fName = document.createElement("td");
        fName.textContent = data.last_name+ ',' + data.first_name
        const amount = document.createElement("td");
        amount.textContent = data.payment_amount
        const payment_date = document.createElement("td")
        payment_date.textContent = data.payment_date
        const payment_status = document.createElement("td");
        payment_status.textContent = data.payment_status;
        tblRow.append(paymentID,id, fName,amount,payment_date,payment_status);
        ListContainer.appendChild(tblRow);
        });
        
    } catch (error) {
        console.error(error.message);
    }
}
getData()
