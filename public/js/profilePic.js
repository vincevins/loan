
document.getElementById("file-upload").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("profile-img").src = e.target.result;
            document.getElementById("navProfile-img").src = e.target.result;
        };
        reader.readAsDataURL(file);
        const formData = new FormData();
        formData.append("profile_picture", file);
        fetch("http://localhost/casestudy-loan/loan/controller/editProfile.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.text())
        .then(data => console.log("Upload success:", data))
        .catch(error => console.error("Upload error:", error));
    }
});
