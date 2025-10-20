<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

require_once 'settings.php';

// Delete EOIs by job reference
if (isset($_POST['delete_by_job'])) {
    $jobRef = $_POST['job_reference'];
    $stmt = $conn->prepare("DELETE FROM eois WHERE job_reference=?");
    $stmt->bind_param("s", $jobRef);
    $stmt->execute();
}

// Update EOI status
if (isset($_POST['update_status'])) {
    $eoiId = $_POST['eoi_id'];
    $newStatus = $_POST['status'];
    $stmt = $conn->prepare("UPDATE eois SET status=? WHERE eoi_id=?");
    $stmt->bind_param("si", $newStatus, $eoiId);
    $stmt->execute();
}

// Sorting
$orderBy = "eoi_id";
if (!empty($_GET['sort'])) {
    $allowed = ["first_name","last_name","job_reference","status"];
    if (in_array($_GET['sort'], $allowed)) {
        $orderBy = $_GET['sort'];
    }
}

// Filtering (job ref / first / last name)
$where = "";
$params = [];
$types = "";
if (!empty($_GET['job_reference'])) {
    $where .= " job_reference=? ";
    $params[] = $_GET['job_reference'];
    $types .= "s";
}
if (!empty($_GET['first_name'])) {
    $where .= ($where ? " AND " : "") . " first_name=? ";
    $params[] = $_GET['first_name'];
    $types .= "s";
}
if (!empty($_GET['last_name'])) {
    $where .= ($where ? " AND " : "") . " last_name=? ";
    $params[] = $_GET['last_name'];
    $types .= "s";
}

$sql = "SELECT * FROM eois";
if ($where) $sql .= " WHERE $where";
$sql .= " ORDER BY $orderBy ASC";

$stmt = $conn->prepare($sql);
if ($params) $stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage EOIs</title>
</head>
<body>
    <h1>EOI Management (Welcome <?= $_SESSION['user']; ?>)</h1>

    <h2>All EOIs</h2>
    <table border="1">
        <tr>
            <th>EOI ID</th><th>Job Ref</th><th>Name</th><th>Email</th><th>Status</th><th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['eoi_id']; ?></td>
            <td><?= $row['job_reference']; ?></td>
            <td><?= $row['first_name']." ".$row['last_name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['status']; ?></td>
            <td>
                <form method="post" style="display:inline">
                    <input type="hidden" name="eoi_id" value="<?= $row['eoi_id']; ?>">
                    <select name="status">
                        <option>New</option>
                        <option>Reviewed</option>
                        <option>Interview</option>
                        <option>Hired</option>
                        <option>Rejected</option>
                    </select>
                    <button type="submit" name="update_status">Update</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Search EOIs</h2>
    <form method="get">
        Job Reference: <input type="text" name="job_reference">
        First Name: <input type="text" name="first_name">
        Last Name: <input type="text" name="last_name">
        <label>Sort by:</label>
        <select name="sort">
            <option value="first_name">First Name</option>
            <option value="last_name">Last Name</option>
            <option value="job_reference">Job Reference</option>
            <option value="status">Status</option>
        </select>
        <button type="submit">Filter/Sort</button>
    </form>

    <h2>Delete EOIs</h2>
    <form method="post">
        <input type="text" name="job_reference" required placeholder="Job Ref">
        <button type="submit" name="delete_by_job">Delete by Job Ref</button>
    </form>
</body>
</html>
<?php
$conn->close();
?>