<?php
$conn = new mysqli("localhost", "root", "", "jobsdb");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$sql = "SELECT * FROM jobs ORDER BY job_id ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="The current job listings for The Charity">
  <meta name="keywords" content="Charity Non-cult Job-Listings">
  <meta name="author" content="4-Bit Squad">
  <title>Jobs</title>
  <link rel="stylesheet" href="styles/project.css">
</head>

<body id="jobs">
  <header>
    <img id="logo" src="images/logo.png" alt="Company Logo">
    <h1>The Charity</h1>
    <p>Build your future with us.</p>
    <nav>
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/jobs.php">Available Jobs</a></li>
        <li><a href="/about">About Us</a></li>
        <li><a href="/apply">Application Form</a></li>
      </ul>
    </nav>
  </header>

  <?php while($job = $result->fetch_assoc()): ?>
  <section class="job-posting">
    <h2><?= htmlspecialchars($job['title']); ?></h2>
    <div class="ref-number">Ref: <?= htmlspecialchars($job['job_reference']); ?></div>
    <p class="short-desc"><?= htmlspecialchars($job['short_desc']); ?></p>
    <p class="reporting-line">Reporting to: <?= htmlspecialchars($job['reporting_line']); ?></p>

    <table>
      <tr>
        <th>Salary</th>
        <td><?= htmlspecialchars($job['salary']); ?></td>
      </tr>
      <tr>
        <th>Location</th>
        <td><?= htmlspecialchars($job['location']); ?></td>
      </tr>
    </table>

    <h3>Key Responsibilities</h3>
    <ul>
      <?php foreach(explode("\n", $job['responsibilities']) as $resp): ?>
        <li><?= htmlspecialchars($resp); ?></li>
      <?php endforeach; ?>
    </ul>

    <h3>Requirements</h3>
    <ol>
      <?php foreach(explode("\n", $job['requirements']) as $req): ?>
        <li><?= htmlspecialchars($req); ?></li>
      <?php endforeach; ?>
    </ol>
  </section>
  <?php endwhile; ?>

  <aside>
    <h3>Why Join The Charity?</h3>
    <p>
      We're a people-first tech company that values innovation, work-life balance, and growth.
      Get competitive benefits, flexible work options, and a collaborative culture.
      <a href="about.html">Learn more about us →</a>
    </p>
  </aside>

  <div id="footer">
    <footer>
      <nav>
        <ul>
          <li><a href="https://github.com/106131320/106131320.github.io" target="_blank">The Charity's Github Page!</a></li>
          <li><a href="https://student-team-zoiq7lxh.atlassian.net/jira/software/projects/SCRUM/boards/1" target="_blank">The Charity's Jira portfolio </a></li>
          <li><a href="mailto:theonlyrealcharity@gmail.com" target="_blank">theonlyrealcharity@gmail.com</a></li>
        </ul>
      </nav>
      <p>© 2025 The Charity</p>
    </footer>
  </div>
</body>
</html>
