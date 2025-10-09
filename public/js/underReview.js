const underReview = document.getElementById('under_reviewBody')

async function getData() {
    const url = 'http://localhost/casestudy-loan/loan/controller/getapplication.php'
    try {
        const response = await fetch(url);
        if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        const ListContainer = document.querySelector(".list");
        ListContainer.innerHTML = "";
        result.forEach((data) => {
        const tblRow = document.createElement("tr");
        const id = document.createElement("td");
        id.textContent = data.loanID
        const fName = document.createElement("td");
        fName.textContent = data.last_name+ ',' + data.first_name
        const amount = document.createElement("td");
        amount.textContent = data.loan_amount
        const application_status = document.createElement("td");
        application_status.textContent = data.application_status;
        const dateApplied = document.createElement("td")
        dateApplied.textContent = data.created_at
        const reviewer = document.createElement("td")
        reviewer.textContent = data.assigned_hr
        const reviewDate = document.createElement("td")
        reviewDate.textContent = data.hr_approval_date 
        const remarks = document.createElement("td")
        remarks.textContent = data.remarks       
        const approveBtn = document.createElement("td");
        const rejectBtn = document.createElement("td");
        approveBtn.innerHTML = `<button class="approve-btn" data-id="${data.id}">APPROVE</button>`;
        rejectBtn.innerHTML = `<button class="reject-btn" data-id="${data.id}">REJECT</button>`;

        tblRow.append(id, fName,amount,application_status,dateApplied,reviewer,reviewDate,remarks,approveBtn,rejectBtn);
        ListContainer.appendChild(tblRow);
        });
        
    } catch (error) {
        console.error(error.message);
    }
}
getData()