<?php
session_start();
require_once 'settings.php'; // Includes the DB connection $conn

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
        $error = "Invalid credentials!";
    }
}
$conn->close(); // Close connection after use
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <form method="post">
        <h2>HR Login</h2>
        <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
        <input type="text" name="username" required placeholder="Username"><br>
        <input type="password" name="password" required placeholder="Password"><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>