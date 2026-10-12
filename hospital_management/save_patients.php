<?php
require_once "db.php";

// Process only form submissions
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Please submit the patient registration form.");
}

// Receive the form data
$fname = trim($_POST["fname"] ?? "");
$lname = trim($_POST["lname"] ?? "");
$gender = $_POST["gender"] ?? "";
$dob = $_POST["dob"] ?? "";
$contactno = trim($_POST["contactno"] ?? "");
$email = trim($_POST["email"] ?? "");
$address = trim($_POST["address"] ?? "");

// Basic server-side validation
if (
    $fname === "" || $lname === "" || $gender === "" ||
    $dob === "" || $contactno === "" || $address === ""
) {
    exit("Please fill in all required fields.");
}

if (!in_array($gender, ["Male", "Female", "Other"], true)) {
    exit("Invalid gender selection.");
}

if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email address.");
}

// Insert the patient using a prepared statement
$sql = "INSERT INTO patients
        (fname, lname, gender, dob, contactno, email, address)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    exit("Could not prepare the database query.");
}

$stmt->bind_param(
    "sssssss",
    $fname,
    $lname,
    $gender,
    $dob,
    $contactno,
    $email,
    $address
);

if ($stmt->execute()) {
    echo "<h2>Patient registered successfully!</h2>";
    echo '<p><a href="register_patient.php">Register another patient</a></p>';
} else {
    echo "Patient registration failed. Please try again.";
}

$stmt->close();
$conn->close();
?>