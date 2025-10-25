function toggleProfileDropdown() {
  const dropdown = document.querySelector(".profile-dropdown");
  dropdown.classList.toggle("active");
}
window.toggleProfileDropdown = toggleProfileDropdown;
document.addEventListener("click", function (event) {
  const dropdown = document.querySelector(".profile-dropdown");
  if (dropdown && !dropdown.contains(event.target)) {
    dropdown.classList.remove("active");
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const dropdownMenu = document.querySelector(".profile-dropdown-menu");
  if (dropdownMenu) {
    dropdownMenu.addEventListener("click", function (event) {
      event.stopPropagation();
    });
  }

  const btnPaymentSched = document.getElementById("btnPaymentSched");
  const btnPersonalInfo = document.getElementById("btnPersonalInfo");
  const personalInfoModal = document.getElementById("personalInfoModal");
  const paymentSchedModal = document.getElementById("paymentSchedModal");

  if (btnPersonalInfo && personalInfoModal && paymentSchedModal) {
    btnPersonalInfo.addEventListener("click", () => {
      personalInfoModal.style.display = "block";
      paymentSchedModal.style.display = "none";
    });
  }

  if (btnPaymentSched && personalInfoModal && paymentSchedModal) {
    btnPaymentSched.addEventListener("click", () => {
      paymentSchedModal.style.display = "block";
      personalInfoModal.style.display = "none";
    });
  }

  const btnPaymentHistory = document.getElementById("btnPaymentHistory");
  const paymentHistoryModal = document.getElementById("paymentHistoryModal");

  if (btnPaymentHistory && paymentHistoryModal) {
    btnPaymentHistory.addEventListener("click", () => {
      personalInfoModal.style.display = "none";
      paymentSchedModal.style.display = "none";
      paymentHistoryModal.style.display = "block";
      loadPaymentHistory();
    });
  }

  const modal = document.getElementById("profileModal");
  const btn = document.getElementById("btnProfile");
  if (btn && modal && dropdownMenu) {
    btn.addEventListener("click", () => {
      modal.style.display = "block";
      dropdownMenu.style.display = "none";
    });

    window.addEventListener("click", (event) => {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  }

  function loadPaymentHistory() {
    fetch("http://localhost/casestudy-loan/loan/controller/paymentHistory.php")
      .then((res) => res.json())
      .then((data) => {
        const tbody = document.querySelector(".paymentHistoryBody");
        tbody.innerHTML = "";

        if (!data || data.length === 0) {
          tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">No payment history found.</td></tr>`;
          return;
        }

        data.forEach((row, i) => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
                        <td>${i + 1}</td>
                        <td>${row.payment_date}</td>
                        <td>₱${Number(row.payment_amount).toLocaleString()}</td>
                        <td>${row.payment_method || "N/A"}</td>
                        <td>${row.payment_reference || "N/A"}</td>
                        <td class="${
                          row.payment_status === "Paid"
                            ? "status-paid"
                            : row.payment_status === "Pending"
                            ? "status-pending"
                            : "status-overdue"
                        }">${row.payment_status}</td>
                    `;
          tbody.appendChild(tr);
        });
      })
      .catch((err) => {
        console.error("Error loading payment history:", err);
        document.querySelector(
          ".paymentHistoryBody"
        ).innerHTML = `<tr><td colspan="6" style="text-align:center;color:red;">Error loading payment history.</td></tr>`;
      });
  }

  const btnPersonalInfo3 = document.getElementById("btnPersonalInfo3");
  const btnPaymentSched3 = document.getElementById("btnPaymentSched3");
  const btnPaymentHistory3 = document.getElementById("btnPaymentHistory3");

  if (btnPersonalInfo3 && btnPaymentSched3 && btnPaymentHistory3) {
    btnPersonalInfo3.addEventListener("click", () => {
      paymentHistoryModal.style.display = "none";
      paymentSchedModal.style.display = "none";
      personalInfoModal.style.display = "block";
    });

    btnPaymentSched3.addEventListener("click", () => {
      paymentHistoryModal.style.display = "none";
      personalInfoModal.style.display = "none";
      paymentSchedModal.style.display = "block";
    });

    btnPaymentHistory3.addEventListener("click", () => {
      personalInfoModal.style.display = "none";
      paymentSchedModal.style.display = "none";
      paymentHistoryModal.style.display = "block";
      loadPaymentHistory();
    });
  }
});
