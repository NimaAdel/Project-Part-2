<?php


require_once("settings.php");

// prevents users from accessing this page directly 
if ($_SERVER["REQUEST_METHOD"] !== "POST" || empty($_POST)) {
    header("Location: apply.php");
    exit();
}

$table = 'eoi';

// sanitises and removes backslashes, whitespaces and converts any html characters to prevent attacks
function sanitise_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

$fields = [
    'reference-number',
    'first-name',
    'last-name',
    'date-of-birth',
    'gender',
    'street-address',
    'town',
    'state',
    'postcode',
    'email',
    'phone-number',
    'other-skills-long'
];

//loops each field and sanitises input
$data = [];
foreach ($fields as $field) {
    $data[$field] = sanitise_input($_POST[$field] ?? '');
}

$skills = ['obedient', 'ignorance', 'social-lack', 'cursive', 'document-signing'];
foreach ($skills as $skill) {
    $data[$skill] = isset($_POST[$skill]) ? 'Yes' : 'No';
}

$data['other-skills'] = isset($_POST['other-skills']) ? 'Yes' : 'No';

// List of required form fields

$required_fields = [
    'reference-number',
    'first-name',
    'last-name',
    'date-of-birth',
    'gender',
    'street-address',
    'town',
    'state',
    'postcode',
    'email',
    'phone-number'
];

$errors = [];
foreach ($required_fields as $field) {
    if (empty($data[$field])) {
        $errors[] = ucfirst(str_replace('-', ' ', $field)) . ' is required.';
    }
}

//validates the required  fields
if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}
if (!empty($data['phone-number']) && !preg_match('/^\+?[0-9\s\-]{8,12}$/', $data['phone-number'])) {
    $errors[] = "Invalid phone number format.";
}
if (!empty($data['postcode']) && !preg_match('/^\d{4}$/', $data['postcode'])) {
    $errors[] = "Invalid postcode format.";
}

// Convert date from DD/MM/YYYY to YYYY-MM-DD for MySQL DATE format
$dob_parts = explode('/', $data['date-of-birth']);
if (count($dob_parts) === 3) {
    $data['date-of-birth'] = $dob_parts[2] . '-' . $dob_parts[1] . '-' . $dob_parts[0];
} else {
    $errors[] = "Invalid date format. Use DD/MM/YYYY.";
}

// Create the EOI table if it doesn't already exist 

$createTableSQL = "
CREATE TABLE IF NOT EXISTS `$table` (
    eoi_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    job_ref CHAR(5) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Other', 'Prefer not to say'),
    street_address VARCHAR(150),
    town VARCHAR(100),
    state CHAR(3),
    postcode CHAR(4),
    email VARCHAR(150),     
    phone_number VARCHAR(15),
    obedient ENUM('Yes','No'),
    ignorance ENUM('Yes','No'),
    social_lack ENUM('Yes','No'),
    cursive ENUM('Yes','No'),
    document_signing ENUM('Yes','No'),
    other_skills ENUM('Yes','No'),
    other_skills_long TEXT,
    status ENUM('New', 'Current', 'Final') DEFAULT 'New'
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


// Execute and check if it was successful
if (mysqli_stmt_execute($stmt)) {
    $eoi_id = mysqli_insert_id($conn);
    echo "<h2>Application submitted successfully!</h2>";
    echo "<p>Your Expression of Interest ID is: <strong>" . htmlspecialchars($eoi_id) . "</strong>. Please keep this for your records.</p>";
    echo "<p><a href='apply.php'>Submit another application</a> | <a href='jobs.php'>View Available Jobs</a></p>";
} else {
    echo "<p>Database error: " . mysqli_error($conn) . "</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>