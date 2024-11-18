document.getElementById('prescriptionForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Simple client-side validation (you can extend this)
    const patientName = document.getElementById('patientName').value;
    const medication = document.getElementById('medication').value;
    const dosage = document.getElementById('dosage').value;

    if (!patientName || !medication || !dosage) {
        alert('Please fill all required fields.');
        return;
    }

    // If all fields are valid, submit the form (simulate AJAX submission)
    alert('Prescription submitted successfully!');

    // Simulate redirect after submission (you can replace this with actual server request)
    window.location.href = "dashboard.html";
});
