const modalOverdue = document.getElementById('modalOverdue')
var span = modalOverdue.querySelector(".BTNclose");
const overdueFname = document.getElementById('overdueFname')
const totalpaymentdue = document.getElementById('total-paymentdue')
const paymentduedate = document.getElementById('payment-duedate')
const daysoverdue = document.getElementById('days-overdue')
const latepayment = document.getElementById('latepayment')
const paystatus = document.getElementById('paystatus')

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
        const dueDate = new Date(data.due_date);
        const formattedDate = dueDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
          });
        const tblRow = document.createElement("tr");
        const id = document.createElement("td");
        id.textContent = data.loanID
        const fName = document.createElement("td");
        fName.textContent = data.last_name+ ', ' + data.first_name
        const amount = document.createElement("td");
        amount.textContent = '₱' + data.total_payment_due
        const due_date = document.createElement("td")
        due_date.textContent = formattedDate
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

document.addEventListener("click", async function (e) {
  const viewButton = e.target.closest(".view-btn");

  if (!viewButton) return;
  const id = viewButton.getAttribute("data-id");
  if (!id) {
    console.error("No data-id found.");
    return;
  }
  modalOverdue.style.display = "flex";
  const url = "http://localhost/casestudy-loan/loan/controller/viewOverdue.php";
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
    const res = await response.json();
    const list = res[0]
    const dueDate = new Date(list.due_date);
    const formattedDate = dueDate.toLocaleDateString('en-US', {year: 'numeric', month: 'long',day: 'numeric'});
    var latepay =  list.days_overdue * list.late_payment
    overdueFname.textContent =  list.first_name + " " + list.middle_name + " " + list.last_name
    totalpaymentdue.textContent = "₱"+list.total_payment_due
    paymentduedate.textContent=  list.due_date
    daysoverdue.textContent = formattedDate
    latepayment.textContent = "₱"+latepay.toFixed(2)
    paystatus.textContent =  list.payment_status
  } catch (error) {
    console.error("Fetch error:", error.message);
  }
});
span.addEventListener('click', function(){
    modalOverdue.style.display = "none";
})
document.getElementById('exportExcel').addEventListener('click', function () {
    const table = document.getElementById('overdue');
    const rows = table.querySelectorAll('tr');
    let csvContent = '';

    rows.forEach(row => {
        const cols = row.querySelectorAll('th, td');
        let rowData = [];
        cols.forEach(col => {
            let cellText = col.textContent.replace(/"/g, '""');
            rowData.push(`"${cellText}"`);
        });
        csvContent += rowData.join(',') + '\n';
    });

    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'overdue.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});
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
