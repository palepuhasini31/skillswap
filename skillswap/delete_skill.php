 <?php

session_start();

include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$skill_id = $_GET['skill_id'];
$user_id = $_SESSION['user_id'];

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM skills
     WHERE skill_id = ?
     AND user_id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $skill_id,
    $user_id
);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Delete Skill - SkillSwap</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<?php

if (mysqli_stmt_execute($stmt)) {

    echo "<h2>Skill Deleted Successfully!</h2>";

    echo "<p>The skill has been removed from your profile.</p>";

    echo "<br>";

    echo '<a href="profile.php">Back to My Profile</a>';

    echo "<br><br>";

    echo '<a href="dashboard.php">Back to Dashboard</a>';

} else {

    echo "<h2>Unable to Delete Skill</h2>";

    echo "<p>Error: " . mysqli_error($conn) . "</p>";

    echo "<br>";

    echo '<a href="profile.php">Back to My Profile</a>';
}

mysqli_stmt_close($stmt);

?>

</div>

</body>

</html>