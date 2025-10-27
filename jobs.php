<?php
// Load DB connection
require_once 'settings.php';

$sql = "SELECT * FROM jobs ORDER BY job_id ASC";
$result = $conn->query($sql);

$body_id = "jobs";
require_once 'header.inc';
?>


<div class="jobs-container">
    <div class="page-title">
        <h1>Current Job Openings</h1>
        <p>Join our team and make an impact where it matters most.</p>
    </div>

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
                <?php foreach (explode("\n", trim($job['responsibilities'])) as $resp): ?>
                    <?php if (trim($resp) !== ''): ?>
                        <li><?= htmlspecialchars($resp); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <h3>Requirements</h3>
            <ol>
                <?php foreach (explode("\n", trim($job['requirements'])) as $req): ?>
                    <?php if (trim($req) !== ''): ?>
                        <li><?= htmlspecialchars($req); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        </section>
    <?php endwhile; ?>

    <aside>
        <h3>Why Join The Charity?</h3>
        <p>
            We're a people-first organization that values purpose, innovation, and collaboration.
            Enjoy flexible work arrangements, growth opportunities, and a supportive culture.
            <a href="about.php">Learn more about us →</a>
        </p>
    </aside>
</div>

<?php
$conn->close();
require_once 'footer.inc';
?>