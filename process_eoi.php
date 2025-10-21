<?php


require_once("header.inc");
require_once("settings.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST" || empty($_POST)) {
    header("Location: apply.php");
    exit();
}

$table = 'eoi';

function sanitise_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$fields = [
    'reference-number', 'first-name', 'last-name', 'date-of-birth', 'gender',
    'street-address', 'town', 'state', 'postcode', 'email', 'phone-number',
    'other-skills-long'
];

$data = [];
foreach ($fields as $field) {
    $data[$field] = sanitise_input($_POST[$field] ?? '');
}

$skills = ['obedient', 'ignorance', 'social-lack', 'cursive', 'document-signing'];
foreach ($skills as $skill) {
    $data[$skill] = isset($_POST[$skill]) ? 'Yes' : 'No';
}

$data['other-skills'] = isset($_POST['other-skills']) ? 'Yes' : 'No';

$required_fields = [
    'reference-number', 'first-name', 'last-name', 'date-of-birth', 'gender',
    'street-address', 'town', 'state', 'postcode', 'email', 'phone-number'
];

$errors = [];
foreach ($required_fields as $field) {
    if (empty($data[$field])) {
        $errors[] = ucfirst(str_replace('-', ' ', $field)) . ' is required.';
    }
}

if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}
if (!empty($data['phone-number']) && !preg_match('/^\+?[0-9\s\-]{8,12}$/', $data['phone-number'])) {
    $errors[] = "Invalid phone number format.";
}
if (!empty($data['postcode']) && !preg_match('/^\d{4}$/', $data['postcode'])) {
    $errors[] = "Invalid postcode format.";
}

$dob_parts = explode('/', $data['date-of-birth']);
if (count($dob_parts) === 3) {
    $data['date-of-birth'] = $dob_parts[2] . '-' . $dob_parts[1] . '-' . $dob_parts[0];
} else {
    $errors[] = "Invalid date format. Use DD/MM/YYYY.";
}


$createTableSQL = "
CREATE TABLE IF NOT EXISTS `$table` (
    eoi_id INT AUTO_INCREMENT PRIMARY KEY,
    job_ref VARCHAR(50) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender VARCHAR(20),
    street_address VARCHAR(255),
    town VARCHAR(100),
    state VARCHAR(50),
    postcode VARCHAR(10),
    email VARCHAR(100),
    phone_number VARCHAR(20),
    obedient VARCHAR(3),
    ignorance VARCHAR(3),
    social_lack VARCHAR(3),
    cursive VARCHAR(3),
    document_signing VARCHAR(3),
    other_skills VARCHAR(3),
    other_skills_long TEXT,
    status VARCHAR(20) DEFAULT 'New'
) ENGINE=InnoDB;
";

if (!mysqli_query($conn, $createTableSQL)) {
    die("<p>Error creating table: " . mysqli_error($conn) . "</p>");
}

$insertSQL = "INSERT INTO `$table`
    (job_ref, first_name, last_name, date_of_birth, gender, street_address, town, state, postcode,
     email, phone_number, obedient, ignorance, social_lack, cursive, document_signing,
     other_skills, other_skills_long)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $insertSQL);

if (!$stmt) {
    die("<p>SQL Prepare failed: " . mysqli_error($conn) . "</p>");
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssssssssss",
    $data['reference-number'],
    $data['first-name'],
    $data['last-name'],
    $data['date-of-birth'],
    $data['gender'],
    $data['street-address'],
    $data['town'],
    $data['state'],
    $data['postcode'],
    $data['email'],
    $data['phone-number'],
    $data['obedient'],
    $data['ignorance'],
    $data['social-lack'],
    $data['cursive'],
    $data['document-signing'],
    $data['other-skills'],
    $data['other-skills-long']
);

if (mysqli_stmt_execute($stmt)) {
    $eoi_id = mysqli_insert_id($conn);
    echo "<h2>Application submitted successfully!</h2>";
} else {
    echo "<p>Database error: " . mysqli_error($conn) . "</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
