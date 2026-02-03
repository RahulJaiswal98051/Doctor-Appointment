<!DOCTYPE html>
<html>
<head>
    <title>Appointment Status Updated for Doctor</title>
</head>
<body>
    <h2>Appointment Status Updated</h2>

    <p>Hello {{ $appointment->doctor->user->name }}</p>

    <p>Your appointment status has been updated.</p>

    <p><strong>Status:</strong> {{ $appointment->status }}</p>
    <p><strong>Date:</strong> {{ $appointment->date }}</p>
    <p><strong>Time:</strong> {{ $appointment->time }}</p>
    <p><strong>Patient Name:</strong> {{ $appointment->user->name }}</p>

    <p>Thank you.</p>
</body>
</html>
