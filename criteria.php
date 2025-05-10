<?php

session_start();

// Redirect if not logged in or not a judge
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "judge") {
    header("Location: login.php");
    exit;
}

$mysqli = require __DIR__ . "/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Prepare the SQL statement
    $sql = "INSERT INTO pro_grade (group_m, project_title, judge_n, req_a, tool_c, o_p, t_func, total, comment)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $mysqli->prepare($sql);
    
    // Calculate the total score
    $total = $_POST["req_a"] + $_POST["tool_c"] + $_POST["o_p"] + $_POST["t_func"];
    
    // Bind the parameters
    $stmt->bind_param(
        "sssiiiii",
        $_POST["group_m"],
        $_POST["project_title"],
        $_SESSION["username"],
        $_POST["req_a"],
        $_POST["tool_c"],
        $_POST["o_p"],
        $_POST["t_func"],
        $total,
        $_POST["comment"]
    );
    
    // Execute the statement
    if ($stmt->execute()) {
        $message = "Grades submitted successfully!";
    } else {
        $message = "Error: " . $mysqli->error;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Grading Form</title>
</head>
<body>
    <h1>Grading Form</h1>

    <?php if (isset($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="group_m">Group Members</label>
        <textarea name="group_m" id="group_m" required></textarea>

        <label for="project_title">Project Title</label>
        <input type="text" name="project_title" id="project_title" required>

        <label for="req_a">Articulate Requirements (0-10)</label>
        <input type="number" name="req_a" id="req_a" min="0" max="10" required>

        <label for="tool_c">Choose Tools (0-10)</label>
        <input type="number" name="tool_c" id="tool_c" min="0" max="10" required>

        <label for="o_p">Oral Presentation (0-10)</label>
        <input type="number" name="o_p" id="o_p" min="0" max="10" required>

        <label for="t_func">Team Function (0-10)</label>
        <input type="number" name="t_func" id="t_func" min="0" max="10" required>

        <label for="comment">Comments</label>
        <textarea name="comment" id="comment"></textarea>

        <button>Submit Grades</button>
    </form>

    <p><a href="logout.php">Log out</a></p>

</body>
</html>
