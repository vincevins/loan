async function getData() {
  const url = "http://localhost/casestudy-loan/loan/controller/overdue.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const result = await response.json();
  } catch (error) {
    console.error(error.message);
  }
}
async function getUpcomingDue() {
  const url = "http://localhost/casestudy-loan/loan/controller/upcomingDue.php";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
     await response.json();
  } catch (error) {
    console.error(error.message);
  }
}

async function getOverdue() {
    const url = "http://localhost/casestudy-loan/loan/controller/getOverdue.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        const active = result.filter(item => item.hasLoan === 1 && item.updated_at !== null);
        const ListContainer = document.querySelector(".listOverdue");
        ListContainer.innerHTML = "";
        active.forEach((data) => {
        const tblRow = document.createElement("tr");
        const id = document.createElement("td");
        id.textContent = data.loanID
        const fName = document.createElement("td");
        fName.textContent = data.last_name+ ', ' + data.first_name
        const amount = document.createElement("td");
        amount.textContent = '₱' + data.total_payment_due
        const due_date = document.createElement("td")
        due_date.textContent = data.due_date
        const days_overdue = document.createElement("td")
        days_overdue.textContent = data.days_overdue
        const payment_status = document.createElement("td");
        payment_status.textContent = data.payment_status;
        const action = document.createElement("td");
        action.innerHTML = `<button class="view-btn" data-id="${data.id}"><i class='far fa-eye'></i></button>`;
        tblRow.append(id, fName,amount,due_date,days_overdue,payment_status,action);
        ListContainer.appendChild(tblRow);
        });
        
    } catch (error) {
        console.error(error.message);
    }
}
async function tblUpcomingDue() {
    const url = "http://localhost/casestudy-loan/loan/controller/getOverdue.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
        }
        const result = await response.json();
        const active = result.filter(item => item.hasLoan === 1 && item.updated_at_upcoming !== null);
        
        const ListContainer = document.querySelector(".listUpcoming");
        ListContainer.innerHTML = "";
        active.forEach((data) => {
        const dueDate = new Date(data.due_date);
        const formattedDate = dueDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
          });
          const tblRow = document.createElement("tr");
          const id = document.createElement("td");
          id.textContent = data.loanID;
          const fName = document.createElement("td");
          fName.textContent = `${data.last_name}, ${data.first_name}`;
          const amount = document.createElement("td");
          amount.textContent = '₱' + data.total_payment_due;
          const due_date = document.createElement("td");
          due_date.textContent = formattedDate; 
          const payment_status = document.createElement("td");
          payment_status.textContent = data.payment_status;
          const action = document.createElement("td");
          action.innerHTML = `<button class="view-btn" data-id="${data.id}"><i class='far fa-eye'></i></button>`;
          tblRow.append(id, fName, amount, due_date, payment_status, action);
          ListContainer.appendChild(tblRow);
        
      });
    } catch (error) {
        console.error(error.message);
    }
}
getData()
getOverdue()
getUpcomingDue()
tblUpcomingDue()
 getData();
setInterval(() => {
  getData();
  getOverdue();
  getUpcomingDue();
  tblUpcomingDue();
}, 5000);
