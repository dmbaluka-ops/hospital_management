<?php
require_once "db.php";

function safe($value) {
    return htmlspecialchars((string)($value ?? ""), ENT_QUOTES, "UTF-8");
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit("Invalid doctor ID.");
}

$stmt = $conn->prepare(
    "SELECT id, fullname, specialisation, contactno
     FROM doctors WHERE id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$doctor = $result->fetch_assoc();
$stmt->close();

if (!$doctor) {
    exit("Doctor not found.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
</head>
<body>
    <h1>Edit Doctor Details</h1>

    <form action="update_doctor.php" method="POST">
        <input type="hidden" name="id" value="<?= safe($doctor["id"]) ?>">

        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname"
               maxlength="100" value="<?= safe($doctor["fullname"]) ?>" required>
        <br><br>

        <label for="specialisation">Specialisation:</label>
        <input type="text" id="specialisation" name="specialisation"
               maxlength="100" value="<?= safe($doctor["specialisation"]) ?>" required>
        <br><br>

        <label for="contactno">Contact Number:</label>
        <input type="tel" id="contactno" name="contactno"
               maxlength="10" value="<?= safe($doctor["contactno"]) ?>">
        <br><br>

        <button type="submit">Save Changes</button>
    </form>

    <p><a href="doctors.php">Back to Doctors</a></p>
</body>
</html>