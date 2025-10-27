<?php
require_once 'settings.php';

$sql = "SELECT * FROM jobs ORDER BY job_id ASC";
$result = $conn->query($sql);

$body_id = "jobs";
require_once 'header.inc';
?>

<style>
    body#jobs {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #eef3ff, #f9f9ff);
        margin: 0;
        color: #333;
    }

    .jobs-container {
        max-width: 1100px;
        margin: 2rem auto;
        padding: 0 2rem;
    }

    .page-title {
        margin-bottom: 2rem;
        border-left: 6px solid #5563DE;
        padding-left: 1rem;
    }

    .page-title h1 {
        font-size: 2.5rem;
        margin: 0;
        color: #2c3e50;
    }

    .page-title p {
        color: #555;
        margin-top: 0.3rem;
        font-size: 1.1rem;
    }

    /* Developer Section Styling */
    .developer-section {
        background: #fff;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 4px 18px rgba(85, 99, 222, 0.15);
        margin-bottom: 2.5rem;
        border-left: 6px solid #5563DE;
    }

    .developer-section h2 {
        color: #5563DE;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .developer-intro {
        color: #444;
        margin-bottom: 1.5rem;
    }

    /* Job Posting Cards */
    .job-posting {
        background: #fdfdfd;
        border-radius: 8px;
        padding: 1.5rem 1.8rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid #74ABE2;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .job-posting:hover {
        transform: translateX(4px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .job-posting h3 {
        color: #2c3e50;
        margin-bottom: 0.4rem;
    }

    .ref-number {
        font-size: 0.9rem;
        color: #888;
        margin-bottom: 0.5rem;
    }

    .short-desc {
        font-size: 1rem;
        margin-bottom: 0.8rem;
        color: #555;
    }

    .job-meta {
        font-size: 0.95rem;
        margin-bottom: 1rem;
        color: #444;
    }

    .job-meta strong {
        color: #2c3e50;
    }

    ul, ol {
        margin: 0.5rem 0 1rem 1.5rem;
    }

    li {
        margin-bottom: 0.3rem;
    }

    .apply-btn {
        display: inline-block;
        background: linear-gradient(90deg, #5563DE, #74ABE2);
        color: white;
        text-decoration: none;
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
        font-weight: 600;
        margin-top: 0.5rem;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .apply-btn:hover {
        background: linear-gradient(90deg, #4350c4, #6598d8);
        transform: translateY(-2px);
    }

    /* Why Join Section */
    aside {
        background: #eaf2ff;
        border-left: 6px solid #5563DE;
        padding: 2rem;
        margin-top: 3rem;
        border-radius: 10px;
    }

    aside h3 {
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 0.8rem;
    }

    aside p {
        color: #333;
        line-height: 1.6;
        font-size: 1rem;
    }

    aside a {
        color: #5563DE;
        text-decoration: none;
        font-weight: 600;
    }

    aside a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .jobs-container {
            padding: 0 1rem;
        }
        .page-title h1 {
            font-size: 2rem;
        }
    }
</style>

<div class="jobs-container">
    <div class="page-title">
        <h1>Current Job Openings</h1>
        <p>Explore our latest opportunities and join a team making a difference.</p>
    </div>

    <!-- Developer Section (Frontend + Backend merged) -->
    <section class="developer-section">
        <h2>Developer Positions</h2>
        <p class="developer-intro">We’re seeking talented developers passionate about building elegant, scalable, and impactful digital solutions. Join our tech team and help shape the future of our digital platform.</p>

        <?php while ($job = $result->fetch_assoc()): ?>
            <?php if (stripos($job['title'], 'Frontend') !== false || stripos($job['title'], 'Backend') !== false): ?>
                <div class="job-posting">
                    <h3><?= htmlspecialchars($job['title']); ?></h3>
                    <div class="ref-number">Ref: <?= htmlspecialchars($job['job_reference']); ?></div>
                    <p class="short-desc"><?= htmlspecialchars($job['short_desc']); ?></p>
                    <p class="job-meta">
                        <strong>Reporting to:</strong> <?= htmlspecialchars($job['reporting_line']); ?><br>
                        <strong>Salary:</strong> <?= htmlspecialchars($job['salary']); ?><br>
                        <strong>Location:</strong> <?= htmlspecialchars($job['location']); ?>
                    </p>

                    <h4>Key Responsibilities</h4>
                    <ul>
                        <?php foreach (explode("\n", trim($job['responsibilities'])) as $resp): ?>
                            <?php if (trim($resp) !== ''): ?>
                                <li><?= htmlspecialchars($resp); ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>

                    <h4>Requirements</h4>
                    <ol>
                        <?php foreach (explode("\n", trim($job['requirements'])) as $req): ?>
                            <?php if (trim($req) !== ''): ?>
                                <li><?= htmlspecialchars($req); ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ol>

                    <a class="apply-btn" href="apply.php?job_id=<?= htmlspecialchars($job['job_id']); ?>">Apply Now →</a>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </section>

    <aside>
        <h3>Why Join The Charity?</h3>
        <p>
            We’re a people-first organization that values creativity, teamwork, and personal growth.
            You’ll enjoy flexible working, professional development, and the chance to make a real impact.
            <a href="about.php">Learn more about us →</a>
        </p>
    </aside>
</div>

<?php
$conn->close();
require_once 'footer.inc';
?>
