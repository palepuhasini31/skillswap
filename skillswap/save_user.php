 <?php

include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $department = $_POST['department'];
    $year = $_POST['year'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    // Check if email already exists
    $check_stmt = mysqli_prepare(
        $conn,
        "SELECT user_id FROM users WHERE email = ?"
    );

    mysqli_stmt_bind_param(
        $check_stmt,
        "s",
        $email
    );

    mysqli_stmt_execute($check_stmt);

    $check_result = mysqli_stmt_get_result($check_stmt);


    if (mysqli_num_rows($check_result) > 0) {

        echo "<h2>Email Already Registered</h2>";

        echo "<p>
              This email is already associated with an account.
              </p>";

        echo '<a href="register.php">Try Another Email</a>';

    } else {

        // Insert new student
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO users
            (name, email, password, department, year)
            VALUES (?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssssi",
            $name,
            $email,
            $hashed_password,
            $department,
            $year
        );


        if (mysqli_stmt_execute($stmt)) {

            echo "<h2>Registration Successful!</h2>";

            echo "<p>
                  Your SkillSwap account has been created.
                  </p>";

            echo '<a href="login.php">Go to Login</a>';

        } else {

            echo "<h2>Registration Failed</h2>";

            echo "<p>
                  Something went wrong while creating your account.
                  </p>";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($check_stmt);

} else {

    echo "Please use the registration form.";

}

?>