<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Appointment - Care Hospital</title>
    <link rel="stylesheet" href="css/dashboard_sty.css">
    <script>
        // Function to confirm cancellation before submission
        function confirmCancel() {
            const appointmentId = document.getElementById('appointmentId').value;
            if (appointmentId === '') {
                alert("Please enter the Appointment ID.");
                return false;
            }
            return confirm("Are you sure you want to cancel this appointment?");
        }
    </script>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <h1>Care Hospital - Cancel Appointment</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="doctors.html">Doctors</a></li>
                    <li><a href="opd_schedule.html">OPD Schedule</a></li>
                    <li><a href="facilities.html">Facilities</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="dashboard.html">Dashboard</a></li>
                    <li><a href="cancel_appointment.html">Cancel Appointment</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="cancel-appointment">
            <h2>Cancel Appointment</h2>
            <form id="cancelForm" action="cancel_appointment.php" method="POST" onsubmit="return confirmCancel();">
                <div class="form-group">
                    <label for="appointmentId">Appointment ID:</label>
                    <input type="text" id="appointmentId" name="appointmentId" placeholder="Enter your Appointment ID" required>
                </div>

                <div class="form-group">
                    <label for="patientName">Patient Name:</label>
                    <input type="text" id="patientName" name="patientName" placeholder="Enter patient's name" required>
                </div>

                <div class="form-group">
                    <label for="reason">Reason for Cancellation (optional):</label>
                    <textarea id="reason" name="reason" placeholder="Enter reason (optional)" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-danger">Cancel Appointment</button>
                    <a href="dashboard.html" class="btn-secondary">Back to Dashboard</a>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Care Hospital | Follow us: 
            <a href="#"><img src="images/facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="images/twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="images/instagram-icon.png" alt="Instagram"></a>
        </p>
    </footer>

    <script src="scripts/dashboard.js"></script>
</body>
</html>