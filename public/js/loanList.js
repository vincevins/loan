async function getData() {
    const url = 'http://localhost/casestudy-loan/loan/controller/getActiveLoan.php'
    try {
        const response = await fetch(url);
        if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        const applicationForm = result.find(item => item.application_status === 'approved');
        const list = [applicationForm]
        const ListContainer = document.querySelector(".list");
        ListContainer.innerHTML = "";
        list.forEach((data) => {
            const status = data.hasLoan
            var loanStatus;
            if(status === 1){
                loanStatus = 'Active'
                console.log('dasdadas');
                
            }
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
            const activeLoan = document.createElement("td")
            activeLoan.textContent = loanStatus
            tblRow.append(id, fName,amount,application_status,dateApplied,reviewer,reviewDate,remarks,activeLoan);
            ListContainer.appendChild(tblRow);
        });
        
    } catch (error) {
        console.error(error.message);
    }
}
getData()
