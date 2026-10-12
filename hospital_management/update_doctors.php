<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Invalid request.");
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$fullname = trim($_POST["fullname"] ?? "");
$specialisation = trim($_POST["specialisation"] ?? "");
$contactno = trim($_POST["contactno"] ?? "");

if (
    !$id || $id < 1 ||
    $fullname === "" || $specialisation === "" ||
    strlen($fullname) > 100 ||
    strlen($specialisation) > 100 ||
    strlen($contactno) > 10
) {
    exit("Please provide valid doctor details.");
}

$stmt = $conn->prepare(
    "UPDATE doctors
     SET fullname = ?, specialisation = ?, contactno = ?
     WHERE id = ?"
);

$stmt->bind_param("sssi", $fullname, $specialisation, $contactno, $id);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();

    header("Location: doctors.php");
    exit;
}

$stmt->close();
$conn->close();

exit("Could not update the doctor.");
?>