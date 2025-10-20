<?php
// Note: The $conn from settings.php is available here
require_once 'settings.php'; // Includes the DB connection

$sql = "SELECT * FROM jobs ORDER BY job_id ASC";
$result = $conn->query($sql);

$body_id = "jobs"; // Set a specific body ID for styling
$body_class = "";
require_once 'header.inc';
?>

<?php while ($job = $result->fetch_assoc()): ?>
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
      <?php foreach (explode("\n", $job['responsibilities']) as $resp): ?>
        <li><?= htmlspecialchars($resp); ?></li>
      <?php endforeach; ?>
    </ul>

    <h3>Requirements</h3>
    <ol>
      <?php foreach (explode("\n", $job['requirements']) as $req): ?>
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
    <a href="about.php">Learn more about us →</a>
  </p>
</aside>

<?php
$conn->close(); // Close connection after use in jobs.php
require_once 'footer.inc';
?>