<?php
// Load DB connection
require_once 'settings.php';

$sql = "SELECT * FROM jobs ORDER BY job_id ASC";
$result = $conn->query($sql);

$body_id = "jobs";
require_once 'header.inc';
?>

<style>
    body#jobs {
        font-family: 'Inter', sans-serif;
        background-color: #f7f9fc;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .jobs-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 1rem;
    }

    .page-title {
        text-align: center;
        margin-bottom: 2rem;
    }

    .page-title h1 {
        font-size: 2.2rem;
        color: #2c3e50;
        margin: 0;
    }

    .job-posting {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        padding: 1.8rem 2rem;
        margin-bottom: 2rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .job-posting:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .job-posting h2 {
        color: #2c3e50;
        margin-bottom: 0.3rem;
    }

    .ref-number {
        color: #888;
        font-size: 0.9rem;
        margin-bottom: 0.8rem;
    }

    .short-desc {
        font-size: 1rem;
        color: #555;
        margin-bottom: 1rem;
    }

    .reporting-line {
        font-style: italic;
        color: #666;
        margin-bottom: 1rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1.5rem;
    }

    th, td {
        padding: 0.5rem 0.8rem;
        text-align: left;
    }

    th {
        width: 30%;
        color: #2c3e50;
        font-weight: 600;
    }

    td {
        color: #555;
    }

    h3 {
        margin-top: 1.5rem;
        color: #2c3e50;
        font-size: 1.2rem;
    }

    ul, ol {
        margin: 0.5rem 0 1rem 1.5rem;
    }

    ul li, ol li {
        margin-bottom: 0.4rem;
        line-height: 1.5;
    }

    aside {
        background: #e9f2ff;
        border-left: 5px solid #5563DE;
        padding: 1.5rem 2rem;
        margin: 3rem auto;
        max-width: 900px;
        border-radius: 8px;
    }

    aside h3 {
        color: #2c3e50;
        margin-top: 0;
    }

    aside p {
        color: #333;
        line-height: 1.6;
    }

    aside a {
        color: #5563DE;
        text-decoration: none;
        font-weight: 500;
    }

    aside a:hover {
        text-decoration: underline;
    }

    @media (max-width: 700px) {
        .job-posting {
            padding: 1.2rem 1.5rem;
        }
        .page-title h1 {
            font-size: 1.8rem;
        }
    }
</style>

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