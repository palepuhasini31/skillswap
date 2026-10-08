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

    <title>Find a Skill - SkillSwap</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>SkillSwap</h1>

    <h2>Find a Skill</h2>

    <p>Search for a skill and find students who can teach you.</p>

    <hr>

    <form action="search_result.php" method="GET">

        <label><b>Enter Skill:</b></label>

        <br><br>

        <input
            type="text"
            name="skill"
            placeholder="Example: Python"
            required
        >

        <br><br>

        <button type="submit">Search Skill</button>

    </form>

    <br>

    <a href="dashboard.php">← Back to Dashboard</a>

</div>

</body>

</html>