const btnProfile = document.getElementById('btnProfile')
const profileModal = document.getElementById('profileModal')
const btnClose = document.querySelector('.btnClose')

btnProfile.addEventListener('click', function(){
    profileModal.style.display = "flex"
   
})

btnClose.addEventListener('click', function(){
    profileModal.style.display = "none"
})