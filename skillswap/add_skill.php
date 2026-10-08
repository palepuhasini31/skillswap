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

    <title>Add Skill - SkillSwap</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>SkillSwap</h1>

    <h2>Add Your Skill</h2>

    <p>Share something you know and help another student learn.</p>

    <hr>

    <form action="save_skill.php" method="POST">

        <label><b>Skill Name</b></label>
        <br>

        <input
            type="text"
            name="skill_name"
            placeholder="Example: Java, Python, C"
            required
        >

        <br><br>

        <label><b>Skill Description</b></label>
        <br>

        <textarea
            name="skill_description"
            rows="6"
            placeholder="Example: I can teach basic Python programming"
            required
        ></textarea>

        <br><br>

        <button type="submit">Add Skill</button>

    </form>

    <hr>

    <a href="dashboard.php">← Back to Dashboard</a>

</div>

</body>

</html>