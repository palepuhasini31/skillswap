 <?php

session_start();

include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT requests.*, 
               users.name,
               skills.skill_name
        FROM requests
        JOIN users ON requests.sender_id = users.user_id
        JOIN skills ON requests.skill_id = skills.skill_id
        WHERE requests.receiver_id = '$user_id'";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Skill Exchange Requests - SkillSwap</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>SkillSwap</h1>

    <h2>Skill Exchange Requests</h2>

    <p>
        Here you can accept or reject skill exchange requests.
    </p>

    <hr>

    <?php

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            echo "<h3>Skill: "
                 . htmlspecialchars($row['skill_name'])
                 . "</h3>";

            echo "<p>";

            echo "<b>Requested By:</b> "
                 . htmlspecialchars($row['name'])
                 . "<br>";

            echo "<b>Status:</b> "
                 . htmlspecialchars($row['status']);

            echo "</p>";

            if ($row['status'] == 'Pending') {

                echo '<a href="update_request.php?id='
                     . $row['request_id']
                     . '&status=Accepted">Accept</a>';

                echo " &nbsp;&nbsp; ";

                echo '<a href="update_request.php?id='
                     . $row['request_id']
                     . '&status=Rejected">Reject</a>';
            }

            echo "<hr>";
        }

    } else {

        echo "<p>No skill exchange requests found.</p>";

    }

    ?>

    <br>

    <a href="dashboard.php">← Back to Dashboard</a>

</div>

</body>

</html>