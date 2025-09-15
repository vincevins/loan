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

        // Form validation
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
            try{
                const res = await fetch(url,{
                    method: 'POST',
                    body: formData
                });
                const result =await res.json()
                if (result.reset_required) {
                     window.location.href = "http://localhost/casestudy-loan/loan/public/pages/set_password.php";
                } else if(result.status === 'error')  {
                  console.log(result.status)
                }else if (result.reset_required === false) {
                    window.location.href ="http://localhost/casestudy-loan/loan/public/pages/loan.php"
                    console.log('success')
                }else{
                    window.location.href = "http://localhost/casestudy-loan/loan/public/pages/index.php";
                }


            } catch (error) {
                console.error(error.message);
                alert("Something went wrong: " + error.message);
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

            if (firstName.trim() === '' || middleName.trim() === '' || lastName.trim() === '' ||
                age.trim() === '' || contact.trim() === '' || email.trim() === '' ||
                password.trim() === '' || confirmPassword.trim() === '') {
                e.preventDefault();
                alert('Please fill in all fields');
                return;
            }

            if (age < 13 || age > 120) {
                e.preventDefault();
                alert('Please enter a valid age between 13 and 120');
                return;
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match');
                return;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                e.preventDefault();
                alert('Please enter a valid email address');
                return;
            }

            const phonePattern = /^[\+]?[1-9][\d]{0,15}$/;
            if (!phonePattern.test(contact.replace(/[\s\-\(\)]/g, ''))) {
                e.preventDefault();
                alert('Please enter a valid contact number');
            }
            const url = 'http://localhost/casestudy-loan/loan/controller/auth.php';
            try{
                const res = await fetch(url,{
                    method: 'POST',
                    body: formData
                });
                const result =await res.json()
                this.reset();
                console.log(result);

            } catch (error) {
                console.error(error.message);
                alert("Something went wrong: " + error.message);
            }
        });

