 <?php

session_start();

include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Get student information */

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM users WHERE user_id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


/* Get student's skills */

$skill_stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM skills WHERE user_id = ?"
);

mysqli_stmt_bind_param(
    $skill_stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($skill_stmt);

$skill_result = mysqli_stmt_get_result($skill_stmt);

?>

<!DOCTYPE html>
<html>

<head>

    <title>My Profile - SkillSwap</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>SkillSwap</h1>

    <h2>My Profile</h2>

    <hr>

    <h3>Student Information</h3>

    <p>
        <b>Name:</b>
        <?php echo htmlspecialchars($user['name']); ?>
    </p>

    <p>
        <b>Email:</b>
        <?php echo htmlspecialchars($user['email']); ?>
    </p>

    <p>
        <b>Department:</b>
        <?php echo htmlspecialchars($user['department']); ?>
    </p>

    <p>
        <b>Year:</b>
        <?php echo htmlspecialchars($user['year']); ?>
    </p>

    <hr>

    <h3>My Skills</h3>

    <?php

    if (mysqli_num_rows($skill_result) > 0) {

        while ($skill = mysqli_fetch_assoc($skill_result)) {

            echo "<p>";

            echo "<b>Skill:</b> "
                 . htmlspecialchars($skill['skill_name'])
                 . "<br>";

            echo "<b>Description:</b> "
                 . htmlspecialchars($skill['skill_description'])
                 . "<br><br>";

            echo '<a href="delete_skill.php?skill_id='
                 . $skill['skill_id']
                 . '"
                 onclick="return confirm(\'Are you sure you want to delete this skill?\');">
                 Delete Skill
                 </a>';

            echo "</p>";

            echo "<hr>";
        }

    } else {

        echo "<p>No skills added yet.</p>";

    }

    ?>

    <br>

    <a href="add_skill.php">+ Add Another Skill</a>

    <br><br>

    <a href="dashboard.php">← Back to Dashboard</a>

</div>

</body>

</html>

<?php

mysqli_stmt_close($skill_stmt);

?>