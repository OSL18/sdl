// Activity class to handle different events
class RestaurantFormActivity {
    constructor() {
        this.form = document.getElementById('restaurantForm');
        this.submitBtn = document.getElementById('submitBtn');
        this.resetBtn = document.getElementById('resetBtn');
        this.showDataBtn = document.getElementById('showDataBtn');
        this.outputDiv = document.getElementById('output');
        
        // Initialize event listeners
        this.initializeEvents();
    }
    
    initializeEvents() {
        // Submit button click event
        this.submitBtn.addEventListener('click', () => this.handleSubmit());
        
        // Reset button click event
        this.resetBtn.addEventListener('click', () => this.handleReset());
        
        // Show data button click event
        this.showDataBtn.addEventListener('click', () => this.displayData());
        
        // Input validation events
        document.getElementById('name').addEventListener('blur', () => this.validateName());
        document.getElementById('cuisine').addEventListener('change', () => this.validateCuisine());
        document.getElementById('rating').addEventListener('blur', () => this.validateRating());
        document.getElementById('address').addEventListener('blur', () => this.validateAddress());
        document.getElementById('phone').addEventListener('blur', () => this.validatePhone());
        document.getElementById('openingHours').addEventListener('blur', () => this.validateHours());
        document.getElementById('website').addEventListener('blur', () => this.validateWebsite());
    }
    
    validateName() {
        const nameInput = document.getElementById('name');
        const errorSpan = document.getElementById('nameError');
        
        if (nameInput.value.trim() === '') {
            errorSpan.textContent = 'Restaurant name is required';
            return false;
        } else {
            errorSpan.textContent = '';
            return true;
        }
    }
    
    validateCuisine() {
        const cuisineSelect = document.getElementById('cuisine');
        const errorSpan = document.getElementById('cuisineError');
        
        if (cuisineSelect.value === '') {
            errorSpan.textContent = 'Please select a cuisine type';
            return false;
        } else {
            errorSpan.textContent = '';
            return true;
        }
    }
    
    validateRating() {
        const ratingInput = document.getElementById('rating');
        const errorSpan = document.getElementById('ratingError');
        
        if (ratingInput.value === '' || isNaN(ratingInput.value)) {
            errorSpan.textContent = 'Please enter a valid rating';
            return false;
        } else if (ratingInput.value < 1 || ratingInput.value > 5) {
            errorSpan.textContent = 'Rating must be between 1 and 5';
            return false;
        } else {
            errorSpan.textContent = '';
            return true;
        }
    }
    
    validateAddress() {
        const addressInput = document.getElementById('address');
        const errorSpan = document.getElementById('addressError');
        
        if (addressInput.value.trim() === '') {
            errorSpan.textContent = 'Address is required';
            return false;
        } else {
            errorSpan.textContent = '';
            return true;
        }
    }
    
    validatePhone() {
        const phoneInput = document.getElementById('phone');
        const errorSpan = document.getElementById('phoneError');
        const phoneRegex = /^[\d\s\-()+]{10,}$/;
        
        if (phoneInput.value.trim() === '') {
            errorSpan.textContent = 'Phone number is required';
            return false;
        } else if (!phoneRegex.test(phoneInput.value)) {
            errorSpan.textContent = 'Please enter a valid phone number';
            return false;
        } else {
            errorSpan.textContent = '';
            return true;
        }
    }
    
    validateHours() {
        const hoursInput = document.getElementById('openingHours');
        const errorSpan = document.getElementById('hoursError');
        
        if (hoursInput.value.trim() === '') {
            errorSpan.textContent = 'Opening hours are required';
            return false;
        } else {
            errorSpan.textContent = '';
            return true;
        }
    }
    
    validateWebsite() {
        const websiteInput = document.getElementById('website');
        const errorSpan = document.getElementById('websiteError');
        
        if (websiteInput.value.trim() !== '' && !websiteInput.validity.valid) {
            errorSpan.textContent = 'Please enter a valid URL (e.g., https://example.com)';
            return false;
        } else {
            errorSpan.textContent = '';
            return true;
        }
    }
    
    validateForm() {
        const isNameValid = this.validateName();
        const isCuisineValid = this.validateCuisine();
        const isRatingValid = this.validateRating();
        const isAddressValid = this.validateAddress();
        const isPhoneValid = this.validatePhone();
        const isHoursValid = this.validateHours();
        const isWebsiteValid = this.validateWebsite();
        
        return isNameValid && isCuisineValid && isRatingValid && 
               isAddressValid && isPhoneValid && isHoursValid && isWebsiteValid;
    }
    
    handleSubmit() {
        if (this.validateForm()) {
            // In a real application, you would send the data to a server here
            alert('Form submitted successfully!');
            this.displayData();
        } else {
            alert('Please fix the errors in the form before submitting.');
        }
    }
    
    handleReset() {
        // Clear all error messages
        const errorSpans = document.querySelectorAll('.error');
        errorSpans.forEach(span => span.textContent = '');
        
        this.outputDiv.innerHTML = '';
        console.log('Form has been reset');
    }
    
    getFormData() {
        const facilities = [];
        document.querySelectorAll('input[name="facilities"]:checked').forEach(checkbox => {
            facilities.push(checkbox.value);
        });
        
        return {
            name: document.getElementById('name').value,
            cuisine: document.getElementById('cuisine').value,
            rating: document.getElementById('rating').value,
            address: document.getElementById('address').value,
            phone: document.getElementById('phone').value,
            openingHours: document.getElementById('openingHours').value,
            website: document.getElementById('website').value,
            description: document.getElementById('description').value,
            facilities: facilities
        };
    }
    
    displayData() {
        const data = this.getFormData();
        let outputHTML = '<h2>Restaurant Data</h2>';
        
        if (data.name.trim() === '') {
            outputHTML += '<p>No data entered yet.</p>';
        } else {
            outputHTML += `
                <table>
                    <tr><th>Field</th><th>Value</th></tr>
                    <tr><td>Name</td><td>${data.name}</td></tr>
                    <tr><td>Cuisine Type</td><td>${data.cuisine}</td></tr>
                    <tr><td>Rating</td><td>${data.rating}</td></tr>
                    <tr><td>Address</td><td>${data.address}</td></tr>
                    <tr><td>Phone</td><td>${data.phone}</td></tr>
                    <tr><td>Opening Hours</td><td>${data.openingHours}</td></tr>
                    <tr><td>Website</td><td>${data.website || 'N/A'}</td></tr>
                    <tr><td>Description</td><td>${data.description || 'N/A'}</td></tr>
                    <tr><td>Facilities</td><td>${data.facilities.join(', ') || 'None'}</td></tr>
                </table>
            `;
        }
        
        this.outputDiv.innerHTML = outputHTML;
    }
}

// Initialize the activity when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const restaurantActivity = new RestaurantFormActivity();
});