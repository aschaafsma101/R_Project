<?php

session_start();

// Redirect if not logged in or not an admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit;
}

$mysqli = require __DIR__ . "/database.php";

// Fetch all submitted grades
$sql = "SELECT * FROM pro_grade ORDER BY project_title";
$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Admin Results</title>
</head>
<body>
    <h1>Admin Results</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Group Members</th>
                    <th>Project Title</th>
                    <th>Judge Name</th>
                    <th>Articulate Requirements</th>
                    <th>Choose Tools</th>
                    <th>Oral Presentation</th>
                    <th>Team Function</th>
                    <th>Total</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["group_m"]) ?></td>
                        <td><?= htmlspecialchars($row["project_title"]) ?></td>
                        <td><?= htmlspecialchars($row["judge_n"]) ?></td>
                        <td><?= htmlspecialchars($row["req_a"]) ?></td>
                        <td><?= htmlspecialchars($row["tool_c"]) ?></td>
                        <td><?= htmlspecialchars($row["o_p"]) ?></td>
                        <td><?= htmlspecialchars($row["t_func"]) ?></td>
                        <td><?= htmlspecialchars($row["total"]) ?></td>
                        <td><?= htmlspecialchars($row["comment"]) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No grades have been submitted yet.</p>
    <?php endif; ?>

    <p><a href="logout.php">Log out</a></p>

</body>
</html>
