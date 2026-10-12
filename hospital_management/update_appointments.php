<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Invalid request.");
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$patient_id = filter_input(INPUT_POST, "patient_id", FILTER_VALIDATE_INT);
$doctor_id = filter_input(INPUT_POST, "doctor_id", FILTER_VALIDATE_INT);
$appointment_date = trim($_POST["appointment_date"] ?? "");
$reason = trim($_POST["reason"] ?? "");

$date = DateTime::createFromFormat("Y-m-d\TH:i", $appointment_date);
$valid_date = $date && $date->format("Y-m-d\TH:i") === $appointment_date;

if (
    !$id || $id < 1 ||
    !$patient_id || $patient_id < 1 ||
    !$doctor_id || $doctor_id < 1 ||
    !$valid_date
) {
    exit("Please provide valid appointment details.");
}

$appointment_date = $date->format("Y-m-d H:i:s");

$stmt = $conn->prepare(
    "UPDATE appointments
     SET patient_id = ?, doctor_id = ?, appointment_date = ?, reason = ?
     WHERE id = ?"
);

$stmt->bind_param(
    "iissi",
    $patient_id,
    $doctor_id,
    $appointment_date,
    $reason,
    $id
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();

    header("Location: appointments.php");
    exit;
}

$stmt->close();
$conn->close();

exit("Could not update the appointment. Check that the selected patient and doctor exist.");
?>