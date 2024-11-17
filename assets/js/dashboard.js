// Simulating data fetch from a backend or API
document.addEventListener('DOMContentLoaded', function () {
    // Simulate loading data from the server or API
    const totalPatients = 1200; // Example data, replace with API call
    const totalDoctors = 15;    // Example data, replace with API call
    const upcomingAppointments = 25; // Example data, replace with API call
    const recentActivities = [
        'Patient John Doe booked an appointment with Dr. Jane Smith.',
        'Dr. John Doe completed a surgery.',
        'Patient Emma Davis canceled an appointment.',
        'Dr. Mike Davis updated the OPD schedule.',
    ]; // Example data, replace with API call

    // Update the dashboard content dynamically
    document.getElementById('total-patients').textContent = totalPatients;
    document.getElementById('total-doctors').textContent = totalDoctors;
    document.getElementById('upcoming-appointments').textContent = upcomingAppointments;

    // Populate recent activities
    const activitiesList = document.getElementById('recent-activities');
    recentActivities.forEach(function (activity) {
        const listItem = document.createElement('li');
        listItem.textContent = activity;
        activitiesList.appendChild(listItem);
    });
});
