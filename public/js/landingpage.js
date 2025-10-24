document.addEventListener("DOMContentLoaded", () => {
document.getElementById("loanForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const amount = parseFloat(document.getElementById("amount").value) || 0;
  const period = parseInt(document.getElementById("period").value) || 0;
  const interest = 1.3; 

  if (amount > 0 && period > 0) {
    const monthlyNoInterest = amount / period;
    const convert = interest / 100;
    const monthlyInterest = amount * convert;
    const totalInterestValue = monthlyInterest * period;
    const monthlyWithInterest = monthlyNoInterest + monthlyInterest;
    const totalAmount = monthlyWithInterest * period;

    document.getElementById("monthlyPayment").textContent =
      "₱" + monthlyWithInterest.toFixed(2);
    document.getElementById("totalInterest").textContent =
      "₱" + totalInterestValue.toFixed(2);
    document.getElementById("totalAmount").textContent =
      "₱" + totalAmount.toFixed(2);

    document.getElementById("results").classList.add("show");
  } else {
    document.getElementById("monthlyPayment").textContent = "";
    document.getElementById("totalInterest").textContent = "";
    document.getElementById("totalAmount").textContent = "";
    document.getElementById("results").classList.remove("show");
  }
});


});