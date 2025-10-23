function showToast(type, message) {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    let iconClass = '';
    if (type === 'success') {
        iconClass = 'fa fa-check';
    } else if (type === 'error') {
        iconClass = 'fa fa-times';
    }
    toast.innerHTML = ` <div class="toast-icon">
     <i class="${iconClass}" aria-hidden="true"></i>
    </div>
    <div class="toast-message">${message}</div>
    <button class="toast-close" onclick="closeToast(this)">x</button>
    `;
    container.appendChild(toast);
    setTimeout(() => {
        closeToast(toast.querySelector('.toast-close'));
    }, 5000);
}
function closeToast(btn) {
    const toast = btn.parentElement;
    toast.classList.add('removing');

    setTimeout(() => {
        toast.remove();
    }, 300);
 }
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
        .then(data => {
            showToast('success', 'Profile picture updated successfully');
        })
        .catch(error => {
            console.error("Upload error:", error);
            showToast('error', 'Failed to update profile picture');
        });
    }
});
