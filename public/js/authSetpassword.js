function showToast(type, message) {
  const container = document.getElementById("toastContainer");
  const toast = document.createElement("div");
  toast.className = `toast ${type}`;
  let iconClass = "";
  if (type === "success") {
    iconClass = "fa fa-check";
  } else if (type === "error") {
    iconClass = "fa fa-times";
  }
  toast.innerHTML = `<div class="toast-icon">
  <i class="${iconClass}" aria-hidden="true"></i>
  </div>
  <div class="toast-message">${message}</div>
  <button class="toast-close" onclick="closeToast(this)">x</button>`;
  container.appendChild(toast);
  setTimeout(() => {
    closeToast(toast.querySelector(".toast-close"));
  }, 5000);
}
function closeToast(btn) {
  const toast = btn.parentElement;
  toast.classList.add("removing");

  setTimeout(() => {
    toast.remove();
  }, 300);
}
const setPassword = document.getElementById("setPasswordForm");
setPassword.addEventListener("submit", async function (e) {
  e.preventDefault();
  const formData = new FormData(this);
  const url = "http://localhost/casestudy-loan/loan/controller/setPassword.php";
  const password = document.getElementById("set_password").value;
  const confirmpassword = document.getElementById("set_confirm_password").value;
  if (password !== confirmpassword) {
    alert("Passwords do not match");
    return;
  }
  try {
    const res = await fetch(url, {
      method: "POST",
      body: formData,
    });
    if(res.success){
      showToast('success', res.message)
    }else{
      showToast('success', res.message)
    }
    
    const result = await res.json();
    if (result.loginform === true) {
      window.location.href =
        "http://localhost/casestudy-loan/loan/public/pages/user/index.php";
    }
  } catch (error) {
    console.error(error.message);
    alert("Something went wrong: " + error.message);
  }
});
