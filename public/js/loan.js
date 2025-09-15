// Toggle mobile navigation
        document.getElementById('navToggle').addEventListener('click', function() {
            document.getElementById('mainNav').classList.toggle('active');
        });
        
        // Multi-step form functionality
        const formSteps = document.querySelectorAll('.form-step');
        const stepButtons = {
            nextBtn: document.getElementById('nextBtn'),
            nextBtn2: document.getElementById('nextBtn2'),
            nextBtn3: document.getElementById('nextBtn3'),
            prevBtn: document.getElementById('prevBtn'),
            prevBtn2: document.getElementById('prevBtn2'),
            prevBtn3: document.getElementById('prevBtn3')
        };
        
        const progressSteps = document.querySelectorAll('.progress-step');
        
        let currentStep = 0;
        
        // Update form steps
        function updateFormStep() {
            formSteps.forEach((step, index) => {
                step.classList.toggle('form-step-active', index === currentStep);
            });
            
            progressSteps.forEach((step, index) => {
                step.classList.toggle('step-active', index === currentStep);
            });
            
            // Update review content on the last step
            if (currentStep === 3) {
                updateReviewContent();
            }
        }
        
        // Next button event listeners
        stepButtons.nextBtn.addEventListener('click', function() {
            if (validateStep(0)) {
                currentStep = 1;
                updateFormStep();
            }
        });
        
        stepButtons.nextBtn2.addEventListener('click', function() {
            if (validateStep(1)) {
                currentStep = 2;
                updateFormStep();
            }
        });
        
        stepButtons.nextBtn3.addEventListener('click', function() {
            if (validateStep(2)) {
                currentStep = 3;
                updateFormStep();
            }
        });
        
        // Previous button event listeners
        stepButtons.prevBtn.addEventListener('click', function() {
            currentStep = 0;
            updateFormStep();
        });
        
        stepButtons.prevBtn2.addEventListener('click', function() {
            currentStep = 1;
            updateFormStep();
        });
        
        stepButtons.prevBtn3.addEventListener('click', function() {
            currentStep = 2;
            updateFormStep();
        });
        
        // Validate form step
        function validateStep(stepIndex) {
            const inputs = formSteps[stepIndex].querySelectorAll('input, select');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = 'red';
                } else {
                    input.style.borderColor = '#ddd';
                }
            });
            
            if (!isValid) {
                alert('Please fill in all required fields.');
            }
            
            return isValid;
        }
        
        // Update review content
        function updateReviewContent() {
            const reviewContent = document.getElementById('reviewContent');
            const formData = new FormData(document.getElementById('loanApplicationForm'));
            
            let html = `
                <div style="background: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <h4 style="margin-bottom: 15px;">Personal Information</h4>
                    <p><strong>Name:</strong> ${formData.get('firstName')} ${formData.get('lastName')}</p>
                    <p><strong>Email:</strong> ${formData.get('email')}</p>
                    <p><strong>Phone:</strong> ${formData.get('phone')}</p>
                    <p><strong>Date of Birth:</strong> ${formData.get('dob')}</p>
                    
                    <h4 style="margin: 20px 0 15px;">Financial Information</h4>
                    <p><strong>Employment:</strong> ${formData.get('employment')}</p>
                    <p><strong>Annual Income:</strong> ₱ ${formData.get('income')}</p>
                    <p><strong>Housing Payment:</strong> ₱ ${formData.get('housing')}</p>
                    
                    <h4 style="margin: 20px 0 15px;">Loan Details</h4>
                    <p><strong>Loan Amount:</strong> ₱ ${formData.get('loanAmount')}</p>
                    <p><strong>Loan Purpose:</strong> ${formData.get('loanPurpose')}</p>
                    <p><strong>Loan Term:</strong> ${formData.get('loanTerm')} months</p>
                </div>
            `;
            reviewContent.innerHTML = html;
        }
        document.getElementById('loanApplicationForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this); 
            const url = "http://localhost/casestudy-loan/loan/controller/insertloanInformation.php";
            try {
                const response = await fetch(url, {
                    method: "POST",
                    body: formData
                });
                const result =await response.json()
                console.log("response:", result); 
                if (!response.ok) {
                    throw new Error(result.message || `Error ${response.status}`);
                }
                alert(result.message || "Application submitted successfully!");
                this.reset();
                currentStep = 0;
                updateFormStep();
                window.scrollTo(0, 0);
                console.log(result);
            } catch (error) {
                console.error(error.message);
                alert("Something went wrong: " + error.message);
            }
        });