document.addEventListener("DOMContentLoaded", () => {
  const burgerMenu = document.querySelector(".burger-menu");
  const navLinks = document.querySelector(".nav-links");
  const navItems = document.querySelectorAll(".nav-links a");

  if (burgerMenu && navLinks) {
    burgerMenu.addEventListener("click", () => {
      burgerMenu.classList.toggle("active");
      navLinks.classList.toggle("active");
      document.body.style.overflow = navLinks.classList.contains("active")
        ? "hidden"
        : "auto";
    });

    navItems.forEach((item) => {
      item.addEventListener("click", () => {
        burgerMenu.classList.remove("active");
        navLinks.classList.remove("active");
        document.body.style.overflow = "auto";
      });
    });

    document.addEventListener("click", (e) => {
      if (!navLinks.contains(e.target) && !burgerMenu.contains(e.target)) {
        burgerMenu.classList.remove("active");
        navLinks.classList.remove("active");
        document.body.style.overflow = "auto";
      }
    });
  }

  const faqButtons = document.querySelectorAll(".faq-question");
  faqButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const answer = button.nextElementSibling;
      if (answer.style.display === "block") {
        answer.style.display = "none";
      } else {
        answer.style.display = "block";
      }
    });
  });
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
