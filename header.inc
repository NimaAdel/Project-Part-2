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


<!-- This php code checks to see if there are any classes or ids specific to the pages body element (defined by a php variable) this allow us to maintain our styling whilst extracting the header -->

<body <?php echo isset($body_id) ? "id=\" $body_id\"" : "" ; ?> class="
    <!-- This line checks to see if a variable named body_id is set and if it is it adds it's value as the id to the body element -->
    <?php echo isset($body_class) ? $body_class : ""; ?>">
    <!-- This does the same as the above line instead for class (I believe this ended up being unnecessary for the project as is but may aswell keep the line here for future styling efforts.)-->

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