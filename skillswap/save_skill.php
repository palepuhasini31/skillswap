 <?php

session_start();

include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];
    $skill_name = $_POST['skill_name'];
    $skill_description = $_POST['skill_description'];

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO skills
        (user_id, skill_name, skill_description)
        VALUES (?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "iss",
        $user_id,
        $skill_name,
        $skill_description
    );

    if (mysqli_stmt_execute($stmt)) {

        echo "<h2>Skill Added Successfully!</h2>";

        echo "<br>";

        echo '<a href="profile.php">View My Profile</a>';

        echo "<br><br>";

        echo '<a href="dashboard.php">Back to Dashboard</a>';

    } else {

        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);

} else {

    echo "Please use the Add Skill form.";
}

?>