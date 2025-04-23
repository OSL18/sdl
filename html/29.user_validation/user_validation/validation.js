document.getElementById('userForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent form from submitting
  
    // Clear previous errors
    clearErrors();
  
    let isValid = true;
  
    // Name Validation
    const name = document.getElementById('name').value.trim();
    if (name === '' || name.length < 3) {
      showError('nameError', 'Name must be at least 3 characters long.');
      isValid = false;
    }
  
    // Email Validation
    const email = document.getElementById('email').value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      showError('emailError', 'Please enter a valid email address.');
      isValid = false;
    }
  
    // Phone Validation
    const phone = document.getElementById('phone').value.trim();
    const phonePattern = /^\d{10}$/;  // Simple pattern for 10-digit numbers
    if (!phonePattern.test(phone)) {
      showError('phoneError', 'Phone number must be 10 digits.');
      isValid = false;
    }
  
    // Password Validation
    const password = document.getElementById('password').value;
    const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    if (!passwordPattern.test(password)) {
      showError('passwordError', 'Password must be at least 8 characters long and include both letters and numbers.');
      isValid = false;
    }
  
    // Address Validation
    const address = document.getElementById('address').value.trim();
    if (address === '') {
      showError('addressError', 'Address cannot be empty.');
      isValid = false;
    }
  
    if (isValid) {
      alert('Form submitted successfully!');
    }
  });
  
  // Function to show error messages
  function showError(id, message) {
    document.getElementById(id).textContent = message;
  }
  
  // Function to clear all error messages
  function clearErrors() {
    document.querySelectorAll('.error').forEach(el => el.textContent = '');
  }