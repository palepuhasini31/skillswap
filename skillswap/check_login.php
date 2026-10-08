 <?php

session_start();

include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Find user by email
    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM users WHERE email = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        // Check password
        if (password_verify($password, $user['password'])) {

            // Login successful
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];

            header("Location: dashboard.php");
            exit();

        } else {

            echo "<h2>Invalid Email or Password</h2>";

            echo "<p>
                  Please check your login details and try again.
                  </p>";

            echo '<a href="login.php">Back to Login</a>';
        }

    } else {

        echo "<h2>Invalid Email or Password</h2>";

        echo "<p>
              Please check your login details and try again.
              </p>";

        echo '<a href="login.php">Back to Login</a>';
    }

    mysqli_stmt_close($stmt);

} else {

    echo "Please use the login form.";

}

?>