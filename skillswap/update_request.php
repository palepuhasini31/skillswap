 <?php

session_start();

include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$request_id = $_GET['id'];
$status = $_GET['status'];

if ($status != 'Accepted' && $status != 'Rejected') {
    die("Invalid request status.");
}

$user_id = $_SESSION['user_id'];

$stmt = mysqli_prepare(
    $conn,
    "UPDATE requests
     SET status = ?
     WHERE request_id = ?
     AND receiver_id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "sii",
    $status,
    $request_id,
    $user_id
);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Request Updated - SkillSwap</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<?php

if (mysqli_stmt_execute($stmt)) {

    echo "<h1>SkillSwap</h1>";

    echo "<h2>Request Updated Successfully!</h2>";

    echo "<p>The skill exchange request has been updated.</p>";

    echo "<p><b>New Status:</b> "
         . htmlspecialchars($status)
         . "</p>";

    echo "<hr>";

    echo '<a href="requests.php">Back to Requests</a>';

    echo "<br><br>";

    echo '<a href="dashboard.php">Back to Dashboard</a>';

} else {

    echo "<h2>Something went wrong</h2>";

    echo "<p>Error: "
         . htmlspecialchars(mysqli_error($conn))
         . "</p>";

    echo "<br>";

    echo '<a href="requests.php">Back to Requests</a>';
}

mysqli_stmt_close($stmt);

?>

</div>

</body>

</html>