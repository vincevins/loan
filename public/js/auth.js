       const container = document.getElementById('container');
        const toggleBtn = document.getElementById('welcome-toggle');
        const mobileToggleBtn = document.getElementById('mobile-toggle-btn');
        const showSignup = document.getElementById('show-signup');
        const showLogin = document.getElementById('show-login');

        function toggleForm() {
            container.classList.toggle('active');
            if (container.classList.contains('active')) {
                toggleBtn.textContent = 'Login';
                if (mobileToggleBtn) mobileToggleBtn.textContent = 'Login';
                document.querySelector('.welcome-text h2').textContent = 'Welcome Back!';
                document.querySelector('.welcome-text p').textContent = 'To keep connected with us please login with your personal info';
            } else {
                toggleBtn.textContent = 'Sign Up';
                if (mobileToggleBtn) mobileToggleBtn.textContent = 'Sign Up';
                document.querySelector('.welcome-text h2').textContent = 'Hello, Friend!';
                document.querySelector('.welcome-text p').textContent = 'Enter your personal details and start your journey with us';
            }
        }

        toggleBtn.addEventListener('click', toggleForm);
        if (mobileToggleBtn) mobileToggleBtn.addEventListener('click', toggleForm);
        showSignup.addEventListener('click', (e) => {
            e.preventDefault();
            toggleForm();
        });
        showLogin.addEventListener('click', (e) => {
            e.preventDefault();
            toggleForm();
        });
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
            toast.innerHTML = `
                <div class="toast-icon">
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
        function showSpinner() {
            const spinner = document.getElementById('loginSpinner');
            if (spinner) {
                spinner.style.display = 'block';
            }
        }

       async function hideSpinner() {
            const spinner = document.getElementById('loginSpinner');
            if (spinner) {
                spinner.style.display = 'none';
            }
        }
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupform');
        loginForm.addEventListener('submit',async function(e) {
             e.preventDefault();
            const formData = new FormData(this); 
            const email = this.querySelector('input[name="email"]').value;
            const password = this.querySelector('input[name="password"]').value;

            if (email.trim() === '' || password.trim() === '') {
                e.preventDefault();
                alert('Please fill in all fields');
            }
             const url = 'http://localhost/casestudy-loan/loan/controller/authLogin.php';
            showSpinner();
            try{
                const res = await fetch(url,{
                    method: 'POST',
                    body: formData
                });
                setInterval(showSpinner,5000)
                const result =await res.json()
                hideSpinner()
                 if (!res.ok) {
                    throw new Error(result.message || `Error ${response.status}`);
                }
                if (result.reset_required) {
                     window.location.href = "http://localhost/casestudy-loan/loan/public/pages/set_password.php";
                } else if(result.status === 'error')  {
                 showToast('error', result.message)
                }else if (result.role === 'user') {
                  
                    window.location.href ="http://localhost/casestudy-loan/loan/public/pages/user/loan.php"
                }else if(result.role === 'admin'){
                    window.location.href ="http://localhost/casestudy-loan/loan/public/pages/admin/index.php"
                }
                else{
                    window.location.href = "http://localhost/casestudy-loan/loan/public/pages/user/index.php";
                }
            } catch (error) {
                console.error(error.message);
                alert("Something went wrong: " + error.message);
            }finally {
                hideSpinner();
            }

        });

        signupForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this); 
            const firstName = this.querySelector('input[name="first_name"]').value;
            const middleName = this.querySelector('input[name="middle_name"]').value;
            const lastName = this.querySelector('input[name="last_name"]').value;
            const age = this.querySelector('input[name="age"]').value;
            const contact = this.querySelector('input[name="contact"]').value;
            const email = this.querySelector('input[name="email"]').value;
            const password = this.querySelector('input[name="password"]').value;
            const confirmPassword = this.querySelector('input[name="confirm_password"]').value;
            var minNumberofChars = 6;
            var maxNumberofChars = 16;
            var hasNumber = /\d/.test(password);
            var hasSpecial = /[!@#$%^&*]/.test(password);
            var validChars = /^[a-zA-Z0-9!@#$%^&*]+$/.test(password);
            if(password.length < minNumberofChars || password.length > maxNumberofChars){
                e.preventDefault();
                showToast('error','Password must be between 6 and 16 characters');
                return;
            }
            if(!hasNumber || !hasSpecial || !validChars){
                e.preventDefault();
                showToast('error','Password should contain at least one number and one special character');
                return;
            }
            if (firstName.trim() === '' || middleName.trim() === '' || lastName.trim() === '' ||
                age.trim() === '' || contact.trim() === '' || email.trim() === '' ||
                password.trim() === '' || confirmPassword.trim() === '') {
                e.preventDefault();
                showToast('error','Please fill in all fields');
                return;
            }
            if (age < 13 || age > 120) {
                e.preventDefault();
                showToast('error','Please enter a valid age between 13 and 120');
                return;
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                showToast('error','Passwords do not match');
               
                return;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                e.preventDefault();
                showToast('error','Please input valid email');
                return;
            }

            const phonePattern = /^09\d{9}$/;
            const cleanedContact = contact.replace(/[\s\-\(\)]/g, '');

            if (!phonePattern.test(cleanedContact)) {
                e.preventDefault();
                showToast('error','Please enter a valid contact number');
                return;
            }
            const url = 'http://localhost/casestudy-loan/loan/controller/auth.php';
            try{
                const res = await fetch(url,{
                    method: 'POST',
                    body: formData
                });
                const result =await res.json()
                if(result.success){
                    showToast('success', result.message)
                }
                this.reset();

            } catch (error) {
                console.error(error.message);
                alert("Something went wrong: " + error.message);
            }
        });

