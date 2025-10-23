function loadPaymentSchedule() {
  fetch("http://localhost/casestudy-loan/loan/controller/paymentSchedule.php")
    .then((response) => response.json())
    .then((data) => {

      const totalLoanAmountSched = document.getElementById("totalLoanAmountSched");
      const remainingBalanceSched = document.getElementById("remainingBalanceSched");
      const nextPaymentDateSched = document.getElementById("nextPaymentDateSched");
      const nextPaymentAmountSched = document.getElementById("nextPaymentAmountSched");

      let dis = data.find((d) => d.payment_status !== "paid");
      if (dis) {
        remainingBalanceSched.textContent = "₱" + Number(dis.beginning_balance).toLocaleString();
        nextPaymentDateSched.textContent = new Date(dis.due_date).toDateString();
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

      const ListContainer = document.querySelector(".paymentScheduleBody");
      ListContainer.innerHTML = "";

      let nextUnpaid = data.find((item) => item.payment_status === "unpaid");

      data.forEach((item, index) => {
        const tblRow = document.createElement("tr");

        tblRow.innerHTML = `
          <td>${index + 1}</td>
          <td>${item.due_date}</td>
          <td>${item.total_payment_due}</td>
          <td>${item.monthly_payment_no_interest}</td>
          <td>${item.interest}</td>
          <td>${item.payment_status}</td>
          <td>
            ${
              item.payment_status === "paid"
                ? `<button disabled style="background:#ccc;border:none;padding:6px 12px;border-radius:6px;">Paid</button>`
                : nextUnpaid && item.id == nextUnpaid.id
                ? `<button class="btnPayLoan" data-id="${item.id}" data-amount="${item.total_payment_due}" style="background:#28a745;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;">Pay</button>`
                : `<button disabled style="background:#ccc;border:none;padding:6px 12px;border-radius:6px;">Locked</button>`
            }
          </td>`;
        ListContainer.appendChild(tblRow);
      });
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
    });
}

loadPaymentSchedule();

// Modal buttons
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
        paypal
          .Buttons({
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
                    amount: { value: amount, currency_code: "PHP" },
                    description: "Loan Payment ID: " + scheduleId,
                  },
                ],
              });
            },

            onApprove: function (data, actions) {
              return actions.order.capture().then(function (details) {

                // ✅ Fix: Ensure we get the real transaction ID
                const transactionId =
                  details.purchase_units?.[0]?.payments?.captures?.[0]?.id ||
                  details.id ||
                  "UNKNOWN_ID";

                fetch("http://localhost/casestudy-loan/loan/controller/updatePayment.php", {
                  method: "POST",
                  headers: { "Content-Type": "application/json" },
                  body: JSON.stringify({
                    schedule_id: scheduleId,
                    paypal_order_id: transactionId,
                  }),
                })
                  .then(async (res) => {
                    const text = await res.text();

                    let resData;
                    try {
                      resData = JSON.parse(text);
                    } catch {
                      throw new Error("Invalid JSON returned by PHP");
                    }

                    if (resData.success) {
                      let message = `
                        <p><strong>Amount Paid:</strong> ₱${Number(amount).toLocaleString()}</p>
                        <p><strong>Transaction ID:</strong> ${transactionId}</p>
                        <p>Status has been updated to <strong>PAID</strong>.</p>
                      `;

                      // 🟢 If email confirmation was sent
                      if (resData.email_sent) {
                        message += `<p style="margin-top:10px;color:green;">A confirmation email has been sent to your registered email address.</p>`;
                      } else {
                        message += `<p style="margin-top:10px;color:#999;">(No confirmation email was sent.)</p>`;
                      }

                      Swal.fire({
                        title: "Payment Successful!",
                        html: message,
                        icon: "success",
                      }).then(() => loadPaymentSchedule());
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
              console.error("PayPal Error:", err);
              Swal.fire("Error", "Payment failed. Please try again.", "error");
            },
          })
          .render("#paypal-button-container");
      },
    });
  }
});
