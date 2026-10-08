 <?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>

    <title>SkillSwap Registration</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>SkillSwap</h1>

    <h2>Student Registration</h2>

    <p>Create your account and start exchanging skills with other students.</p>

    <hr>

    <form action="save_user.php" method="POST">

        <label><b>Full Name</b></label>
        <br>

        <input
            type="text"
            name="name"
            placeholder="Enter your full name"
            required
        >

        <br><br>

        <label><b>Email</b></label>
        <br>

        <input
            type="email"
            name="email"
            placeholder="Enter your email"
            required
        >

        <br><br>

        <label><b>Password</b></label>
        <br>

        <input
            type="password"
            name="password"
            placeholder="Create a password"
            required
        >

        <br><br>

        <label><b>Department</b></label>
        <br>

        <input
            type="text"
            name="department"
            placeholder="Example: CSE"
            required
        >

        <br><br>

        <label><b>Year</b></label>
        <br>

        <input
            type="number"
            name="year"
            placeholder="Example: 2"
            min="1"
            max="4"
            required
        >

        <br><br>

        <button type="submit">Create Account</button>

    </form>

    <hr>

    <p>Already have an account?</p>

    <a href="login.php">Login Here</a>

</div>

</body>

</html>