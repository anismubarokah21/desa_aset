// Document ready function
document.addEventListener("DOMContentLoaded", function() {
    console.log("Document is ready!");

    // Example of form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            let valid = true;

            // Check if all inputs are filled
            const inputs = form.querySelectorAll('input[required], select[required]');
            inputs.forEach(input => {
                if (!input.value) {
                    valid = false;
                    input.style.border = "1px solid red";
                } else {
                    input.style.border = "1px solid #ccc";
                }
            });

            if (!valid) {
                event.preventDefault();
                alert("Please fill out all required fields.");
            }
        });
    });
});