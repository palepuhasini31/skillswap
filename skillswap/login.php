 <!DOCTYPE html>
<html>

<head>
    <title>SkillSwap Login</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>SkillSwap</h1>

    <h2>Student Login</h2>

    <form action="check_login.php" method="POST">

        <label>Email:</label>
        <br>

        <input type="email" name="email" required>

        <br><br>

        <label>Password:</label>
        <br>

        <input type="password" name="password" required>

        <br><br>

        <button type="submit">Login</button>

    </form>

    <br>

    <p>New student?</p>

    <a href="register.php">Create an Account</a>

</div>

</body>

</html>