```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hospital Management System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f7fb;
            color: #263238;
        }

        /* Header */
        header {
            background-color: #075985;
            color: white;
            padding: 22px 7%;
        }

        header h1 {
            margin: 0;
            font-size: 26px;
        }

        header p {
            margin-bottom: 0;
        }

        /* Navigation menu */
        nav {
            background-color: #ffffff;
            padding: 15px 7%;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            border-bottom: 1px solid #dce3ea;
        }

        nav a {
            text-decoration: none;
            color: #075985;
            padding: 10px 14px;
            border-radius: 5px;
            font-weight: bold;
        }

        nav a:hover {
            background-color: #e0f2fe;
        }

        /* Main content */
        main {
            padding: 30px 7%;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h2 {
            margin-bottom: 8px;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: white;
            padding: 24px;
            border-radius: 10px;
            border: 1px solid #e0e7ef;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        .card h3 {
            margin-top: 0;
            color: #075985;
        }

        .card p {
            line-height: 1.6;
            color: #52616b;
        }

        .button {
            display: inline-block;
            background-color: #075985;
            color: white;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 5px;
            margin: 5px 5px 0 0;
        }

        .button:hover {
            background-color: #0c4a6e;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #64748b;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            header, nav, main {
                padding-left: 5%;
                padding-right: 5%;
            }

            nav {
                gap: 5px;
            }
        }
    </style>
</head>

<body>

    <header>
        <h1>Hospital Management System</h1>
        <p>Manage patients, doctors and appointments in one place.</p>
    </header>

    <nav aria-label="Main navigation">
        <a href="index.php">Home</a>
        <a href="patients.php">Patients</a>
        <a href="register_patient.php">Register Patient</a>
        <a href="doctors.php">Doctors</a>
        <a href="register_doctor.php">Register Doctor</a>
        <a href="appointments.php">Appointments</a>
        <a href="book_appointment.php">Book Appointment</a>
    </nav>

    <main>
        <section class="welcome">
            <h2>Welcome to the Dashboard</h2>
            <p>
                Select a section below to manage hospital records
                and appointments.
            </p>
        </section>

        <section class="dashboard">

            <div class="card">
                <h3>Patient Management</h3>
                <p>
                    Register new patients, view patient records,
                    update details and delete eligible records.
                </p>
                <a class="button" href="patients.php">View Patients</a>
                <a class="button" href="register_patient.php">
                    Register Patient
                </a>
            </div>

            <div class="card">
                <h3>Doctor Management</h3>
                <p>
                    Register doctors, view their specialisations
                    and manage their records.
                </p>
                <a class="button" href="doctors.php">View Doctors</a>
                <a class="button" href="register_doctor.php">
                    Add Doctor
                </a>
            </div>

            <div class="card">
                <h3>Appointment Management</h3>
                <p>
                    Schedule appointments, view bookings,
                    edit appointment details and cancel bookings.
                </p>
                <a class="button" href="appointments.php">
                    View Appointments
                </a>
                <a class="button" href="book_appointment.php">
                    Book Appointment
                </a>
            </div>

        </section>
    </main>

    <footer>
        Hospital Management System &copy; 2026
    </footer>

</body>
</html>
```