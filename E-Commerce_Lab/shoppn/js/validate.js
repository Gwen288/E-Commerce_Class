const registrationForm = document.getElementById('registrationForm');

if (registrationForm) {

    registrationForm.addEventListener('submit', function (event) {

        let isValid = true;

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^[0-9+\-\s]{7,15}$/;


        // Get form fields
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const pass = document.getElementById('pass');
        const country = document.getElementById('country');
        const city = document.getElementById('city');
        const contact = document.getElementById('contact');


        // Clear previous error messages
        document.querySelectorAll('.field-error').forEach(function (error) {
            error.textContent = '';
        });


        // Full Name validation
        if (name.value.trim() === '') {

            document.getElementById('nameError').textContent =
                'Full name is required.';

            isValid = false;
        }


        // Email validation
        if (email.value.trim() === '') {

            document.getElementById('emailError').textContent =
                'Email is required.';

            isValid = false;

        } else if (!emailRegex.test(email.value.trim())) {

            document.getElementById('emailError').textContent =
                'Enter a valid email address.';

            isValid = false;
        }


        // Password validation
        if (pass.value === '') {

            document.getElementById('passError').textContent =
                'Password is required.';

            isValid = false;
        }


        // Country validation
        if (country.value === '') {

            document.getElementById('countryError').textContent =
                'Please select a country.';

            isValid = false;
        }


        // City validation
        if (city.value.trim() === '') {

            document.getElementById('cityError').textContent =
                'City is required.';

            isValid = false;
        }


        // Contact validation
        if (contact.value.trim() === '') {

            document.getElementById('contactError').textContent =
                'Contact number is required.';

            isValid = false;

        } else if (!phoneRegex.test(contact.value.trim())) {

            document.getElementById('contactError').textContent =
                'Enter a valid contact number.';

            isValid = false;
        }


        // Stop form submission if validation fails
        if (!isValid) {

            event.preventDefault();

            return;
        }


        // Loading state
        const registerButton = document.getElementById('registerButton');

        registerButton.disabled = true;
        registerButton.textContent = 'Creating Account...';

    });

}

