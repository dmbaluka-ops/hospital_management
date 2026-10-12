<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Please submit the edit form.");
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$fname = trim($_POST["fname"] ?? "");
$lname = trim($_POST["lname"] ?? "");
$gender = $_POST["gender"] ?? "";
$dob = $_POST["dob"] ?? "";
$contactno = trim($_POST["contactno"] ?? "");
$email = trim($_POST["email"] ?? "");
$address = trim($_POST["address"] ?? "");

if (
    !$id || $id < 1 || $fname === "" || $lname === "" ||
    !in_array($gender, ["Male", "Female", "Other"], true) ||
    $dob === "" || $contactno === "" || $address === ""
) {
    exit("Please provide valid values for all required fields.");
}

if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email address.");
}

$sql = "UPDATE patients
        SET fname = ?, lname = ?, gender = ?, dob = ?,
            contactno = ?, email = ?, address = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssssi",
    $fname, $lname, $gender, $dob,
    $contactno, $email, $address, $id
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();

    header("Location: patients.php");
    exit;
}

$stmt->close();
$conn->close();
exit("Patient update failed. Please try again.");
?>