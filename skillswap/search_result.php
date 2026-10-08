 <?php

session_start();

include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$skill = $_GET['skill'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT skills.*, users.name, users.department, users.year
     FROM skills
     JOIN users ON skills.user_id = users.user_id
     WHERE skills.skill_name LIKE ?"
);

$search_skill = "%" . $skill . "%";

mysqli_stmt_bind_param(
    $stmt,
    "s",
    $search_skill
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Search Results - SkillSwap</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>SkillSwap</h1>

    <h2>Skill Search Results</h2>

    <p>
        Showing results for:
        <b><?php echo htmlspecialchars($skill); ?></b>
    </p>

    <hr>

    <?php

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            echo "<h3>"
                 . htmlspecialchars($row['skill_name'])
                 . "</h3>";

            echo "<p>";

            echo "<b>Student Name:</b> "
                 . htmlspecialchars($row['name'])
                 . "<br>";

            echo "<b>Department:</b> "
                 . htmlspecialchars($row['department'])
                 . "<br>";

            echo "<b>Year:</b> "
                 . htmlspecialchars($row['year'])
                 . "<br>";

            echo "<b>Description:</b> "
                 . htmlspecialchars($row['skill_description']);

            echo "</p>";

            echo '<a href="request_skill.php?skill_id='
                 . $row['skill_id']
                 . '&receiver_id='
                 . $row['user_id']
                 . '">Request Skill Exchange</a>';

            echo "<hr>";
        }

    } else {

        echo "<p>No matching skill found.</p>";

    }

    ?>

    <br>

    <a href="find.php">← Search Again</a>

    <br><br>

    <a href="dashboard.php">← Back to Dashboard</a>

</div>

</body>

</html>

<?php

mysqli_stmt_close($stmt);

?>