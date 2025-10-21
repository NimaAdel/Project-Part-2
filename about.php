<?php
// Set up database connection (from settings.php)
require_once 'settings.php';

// Fetch member contributions from the database
$membersData = [];
$sql = "SELECT member_name, student_id, contributions, quote FROM about ORDER BY id ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $membersData[] = $row;
    }
}
$conn->close();
require_once 'header.inc';
?>


  <main class="container">
    <section class="card">
      <h2>Group Name</h2>
      <p><strong>4-Bit Squad</strong></p>
    </section>

    <section class="card">
      <h2>Class Info</h2>
      <ul>
        <li>Semester 2, 2025
          <ul>
            <li>Lecture: Wed 2–4 pm</li>
            <li>Lab: Fri 10–12 pm</li>
          </ul>
        </li>
      </ul>
    </section>

    <section class="card">
      <h2>Group Photo</h2>
      <figure class="team-figure">
        <img src="images/group-photo.png" alt="4-Bit Squad group photo at Swinburne">
        <figcaption>Our team (image &lt;300KB)</figcaption>
      </figure>
    </section>

    <section class="card">
      <h2>Contributions &amp; Quotes</h2>
      <dl>
        <?php if (!empty($membersData)): ?>
            <?php foreach ($membersData as $member): ?>
                <dt><?= htmlspecialchars($member['member_name']); ?> (<?= htmlspecialchars($member['student_id']); ?>)</dt>
                <dd>
                    <ul>
                        <li><?= nl2br(htmlspecialchars($member['contributions'])); ?></li>
                        <li>Quote: “<?= htmlspecialchars($member['quote']); ?>”</li>
                    </ul>
                </dd>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No member data available.</p>
        <?php endif; ?>
      </dl>
    </section>

    <section class="card">
      <h2>Fun Facts</h2>
      <table>
        <caption>Team Snapshots</caption>
        <thead>
          <tr>
            <th>Member</th>
            <th>Dream Job</th>
            <th>Coding Snack</th>
            <th>Hometown</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Sanduni (105524495)</td>
            <td>Data Scientist</td>
            <td>Banana bread</td>
            <td>Boronia</td>
          </tr>
          <tr>
            <td>Samuel (Soph) Newbegin (105337923)</td>
            <td>Creative developer in a supportive collective</td>
            <td>Nachos</td>
            <td>Blackburn South</td>
          </tr>
          <tr>
            <td>Nima Adel(105911262)</td>
            <td>Computer scientist in Artificial Intelligence</td>
            <td>Pizza</td>
            <td>Blackburn North</td>
          </tr>
          <tr>
            <td>Zoe(106131320)</td>
            <td>Community-focused engineer</td>
            <td>Monster energy + mandarins</td>
            <td>Boronia</td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>

<?php require_once 'footer.inc'; ?>