function loadPaymentSchedule() {
  fetch("http://localhost/casestudy-loan/loan/controller/paymentSchedule.php")
    .then((response) => response.json())
    .then((data) => {
      console.log("Fetched:", data);

      const totalLoanAmountSched = document.getElementById("totalLoanAmountSched");
      const remainingBalanceSched = document.getElementById("remainingBalanceSched");
      const nextPaymentDateSched = document.getElementById("nextPaymentDateSched");
      const nextPaymentAmountSched = document.getElementById("nextPaymentAmountSched");

      // Find first unpaid record (next payment)
      let dis = data.find((d) => d.payment_status !== "paid");
      if (dis) {
        remainingBalanceSched.textContent = "₱" + Number(dis.beginning_balance).toLocaleString();
        let dateFormatter = new Date(dis.due_date).toDateString();
        nextPaymentDateSched.textContent = dateFormatter;
        nextPaymentAmountSched.textContent = "₱" + Number(dis.total_payment_due).toLocaleString();
      }

      const totalAmmount = document.getElementById("totalLoanAmount");
      const remaining = document.getElementById("remainingBalance");
      const nextDue = document.getElementById("nextPaymentDate");
      const nextPayment = document.getElementById("nextPaymentAmount");

      totalAmmount.textContent = "₱" + Number(data[0].beginning_balance).toLocaleString();

      let display = data.find((item) => item.payment_status !== "paid");
      if (display) {
        remaining.textContent = "₱" + Number(display.beginning_balance).toLocaleString();
        nextDue.textContent = new Date(display.due_date).toDateString();
        nextPayment.textContent = "₱" + Number(display.total_payment_due).toLocaleString();
      }

      // 🟢 Payment Schedule Table
      const ListContainer = document.querySelector(".paymentScheduleBody");
      ListContainer.innerHTML = "";

      // Find the first unpaid payment (the next one due)
      let nextUnpaid = data.find((item) => item.payment_status === "unpaid");

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

        const action = document.createElement("td");

        // 🧩 Enable only the next unpaid row
        if (item.payment_status === "paid") {
          action.innerHTML = `<button class="btnPayLoan" disabled style="background:#ccc;border:none;padding:6px 12px;border-radius:6px;">Paid</button>`;
        } else if (nextUnpaid && item.id == nextUnpaid.id) {
          action.innerHTML = `<button class="btnPayLoan" data-id="${item.id}" data-amount="${item.total_payment_due}" style="background:#28a745;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Pay</button>`;
        } else {
          action.innerHTML = `<button class="btnPayLoan" disabled style="background:#ccc;border:none;padding:6px 12px;border-radius:6px;">Locked</button>`;
        }

        tblRow.append(id, duedate, paymentdue, no_interest, total_interest, status, action);
        ListContainer.appendChild(tblRow);
      });
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });
}

// 🟢 Load payment schedule initially
loadPaymentSchedule();

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

// 🟡 PAYPAL SANDBOX PAYMENT FUNCTIONS
document.addEventListener("click", (event) => {
  if (event.target.classList.contains("btnPayLoan")) {
    const scheduleId = event.target.getAttribute("data-id");
    const amount = event.target.getAttribute("data-amount");

    Swal.fire({
      title: "Pay with PayPal",
      html: `<div id="paypal-button-container"></div>`,
      showConfirmButton: false,
      didOpen: () => {
        paypal.Buttons({
          style: {
            layout: "vertical",
            color: "gold",
            shape: "rect",
            label: "paypal",
          },

          createOrder: function (data, actions) {
            return actions.order.create({
              purchase_units: [
                {
                  amount: {
                    value: amount,
                    currency_code: "PHP",
                  },
                  description: "Loan Payment ID: " + scheduleId,
                },
              ],
            });
          },

          onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
              const transactionId = details.id;

              fetch("http://localhost/casestudy-loan/loan/controller/updatePayment.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                  schedule_id: scheduleId,
                  paypal_order_id: transactionId,
                }),
              })
                .then((res) => res.json())
                .then((resData) => {
                  if (resData.success) {
                    Swal.fire({
                      title: "Payment Successful!",
                      html: `
                        <p><strong>Amount Paid:</strong> ₱${Number(amount).toLocaleString()}</p>
                        <p><strong>Transaction ID:</strong> ${transactionId}</p>
                        <p>Status has been updated to <strong>PAID</strong>.</p>
                      `,
                      icon: "success",
                    }).then(() => {
                      // 🔄 Reload only the table and summary data
                      loadPaymentSchedule();
                    });
                  } else {
                    Swal.fire("Error", resData.message || "Failed to update payment.", "error");
                  }
                })
                .catch((err) => {
                  console.error("Update error:", err);
                  Swal.fire("Error", "Failed to update payment status.", "error");
                });
            });
          },

          onError: function (err) {
            console.error(err);
            Swal.fire("Error", "Payment failed. Please try again.", "error");
          },
        }).render("#paypal-button-container");
      },
    });
  }
});
