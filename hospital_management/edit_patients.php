<?php
require_once "db.php";

function safe($value) {
    return htmlspecialchars((string)($value ?? ""), ENT_QUOTES, "UTF-8");
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit("Invalid patient ID.");
}

$stmt = $conn->prepare(
    "SELECT id, fname, lname, gender, dob, contactno, email, address
     FROM patients WHERE id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$patient = $result->fetch_assoc();

$stmt->close();

if (!$patient) {
    exit("Patient not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
</head>
<body>

<h1>Hospital Management System</h1>
<h2>Edit Patient Details</h2>

<form action="update_patient.php" method="POST">

    <input type="hidden" name="id" value="<?= safe($patient['id']) ?>">

    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname"
           value="<?= safe($patient['fname']) ?>" required>
    <br><br>

    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname"
           value="<?= safe($patient['lname']) ?>" required>
    <br><br>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <?php foreach (["Male", "Female", "Other"] as $option): ?>
            <option value="<?= safe($option) ?>"
                <?= $patient['gender'] === $option ? "selected" : "" ?>>
                <?= safe($option) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob"
           value="<?= safe($patient['dob']) ?>" required>
    <br><br>

    <label for="contactno">Contact Number:</label>
    <input type="tel" id="contactno" name="contactno"
           maxlength="10" value="<?= safe($patient['contactno']) ?>" required>
    <br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"
           value="<?= safe($patient['email']) ?>">
    <br><br>

    <label for="address">Address:</label>
    <textarea id="address" name="address" required><?= safe($patient['address']) ?></textarea>
    <br><br>

    <button type="submit">Save Changes</button>
</form>

<p><a href="patients.php">Back to Patients</a></p>

</body>
</html>