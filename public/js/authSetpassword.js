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
    const result = await res.json();
    if(result.loginform === true){
         window.location.href = "http://localhost/casestudy-loan/loan/public/pages/index.php";
    }
 
  } catch (error) {
    console.error(error.message);
    alert("Something went wrong: " + error.message);
  }
});
