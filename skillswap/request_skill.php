 <?php

session_start();

include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sender_id = $_SESSION['user_id'];

$receiver_id = $_GET['receiver_id'];
$skill_id = $_GET['skill_id'];

/* Prepare SQL statement */

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO requests
    (sender_id, receiver_id, skill_id, status)
    VALUES (?, ?, ?, 'Pending')"
);

mysqli_stmt_bind_param(
    $stmt,
    "iii",
    $sender_id,
    $receiver_id,
    $skill_id
);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Request Skill - SkillSwap</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<?php

if (mysqli_stmt_execute($stmt)) {

    echo "<h1>SkillSwap</h1>";

    echo "<h2>Request Sent Successfully!</h2>";

    echo "<p>Your skill exchange request has been sent.</p>";

    echo "<p>The student can now accept or reject your request.</p>";

    echo "<hr>";

    echo '<a href="find.php">Find Another Skill</a>';

    echo "<br><br>";

    echo '<a href="dashboard.php">Back to Dashboard</a>';

} else {

    echo "<h2>Something went wrong</h2>";

    echo "<p>Error: " . mysqli_error($conn) . "</p>";

    echo "<br>";

    echo '<a href="dashboard.php">Back to Dashboard</a>';
}

mysqli_stmt_close($stmt);

?>

</div>

</body>

</html>