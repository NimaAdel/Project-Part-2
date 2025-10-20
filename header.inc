<?php require_once 'settings.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="The Charity Website" />
    <meta name="keywords" content="Charity, Non-profit, Jobs, About" />
    <meta name="author" content="4-Bit Squad" />
    <title>The Charity</title>
    <link rel="stylesheet" href="/styles/project.css" type="text/css">
</head>

<body <?php echo isset($body_id) ? "id=\" $body_id\"" : "" ; ?> class="
    <?php echo isset($body_class) ? $body_class : ""; ?>">

    <header>
        <img id="logo" src="images/logo.png" alt="Company Logo">
        <h1>The Charity</h1>
        <p>Build your future with us.</p>

        <nav>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="/jobs.php">Available Jobs</a></li>
                <li><a href="/about.php">About Us</a></li>
                <li><a href="/apply.php">Application Form</a></li>
            </ul>
        </nav>
    </header>