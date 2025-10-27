<?php
session_start();
require_once 'settings.php'; // Includes the DB connection $conn

// Creating a test user and hashing it in open code does not help given people can see the password in plain text if they look at the php. Removed

// --- HANDLE LOGIN ---
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result['password_hash'])) {
        $_SESSION['user'] = $username;
        header("Location: manage.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Login</title>
    <link rel="stylesheet" href="styles/project.css">
</head>

<body id="login">
    <div class="login-container">
        <h2>HR Login</h2>

        <?php if (!empty($message)): ?>
            <div class="success-message"><?= $message ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <a href="/">← Return to homepage</a>
    </div>
</body>

</html>