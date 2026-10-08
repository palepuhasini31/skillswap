 <?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>SkillSwap Dashboard</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>SkillSwap</h1>

    <h2>College Skill Exchange Platform</h2>

    <p>
        Welcome! What would you like to do?
    </p>

    <hr>

    <h3>Student Menu</h3>

    <p>
        <a href="profile.php">👤 My Profile</a>
    </p>

    <p>
        <a href="add_skill.php">➕ Add My Skill</a>
    </p>

    <p>
        <a href="find.php">🔍 Find a Skill</a>
    </p>

    <p>
        <a href="requests.php">📩 Skill Exchange Requests</a>
    </p>

    <hr>

    <p>
        <a href="logout.php">🚪 Logout</a>
    </p>

</div>

</body>

</html>