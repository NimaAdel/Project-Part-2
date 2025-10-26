<?php
session_start();
require_once 'settings.php'; // Includes the DB connection $conn

// --- AUTO-CREATE TEST USER IF USERS TABLE IS EMPTY ---
$check = $conn->query("SELECT COUNT(*) AS count FROM users");
if ($check && $check->fetch_assoc()['count'] == 0) {
    $username = 'hr_admin';
    $password = 'SecurePass123';
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hash);
    $stmt->execute();
    $stmt->close();

    $message = "✅ A test user has been created:<br>
                <strong>Username:</strong> hr_admin<br>
                <strong>Password:</strong> SecurePass123";
}
// ------------------------------------------------------

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

    <!-- Optional: Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #74ABE2, #5563DE);
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #fff;
            padding: 2.5rem 3rem;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 1.5rem;
            color: #333;
        }

        .login-container input {
            width: 100%;
            padding: 12px 14px;
            margin: 0.5rem 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .login-container input:focus {
            border-color: #5563DE;
            outline: none;
            box-shadow: 0 0 5px rgba(85, 99, 222, 0.3);
        }

        .login-container button {
            width: 100%;
            background: #5563DE;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
            transition: background 0.3s;
        }

        .login-container button:hover {
            background: #3d4bb5;
        }

        .error-message {
            color: #e74c3c;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .success-message {
            color: #27ae60;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .login-container a {
            display: inline-block;
            margin-top: 1rem;
            color: #5563DE;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
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