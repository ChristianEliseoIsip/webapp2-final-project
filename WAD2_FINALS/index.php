<?php
require 'config.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM `users` WHERE username = :username";
            $statement = $pdo->prepare($query);
            $statement->execute([':username' => $username]);

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ('bsis2' === $password) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    header("Location: loading.php");
                    exit;
                } else {
                    echo '<div class="errorContainer"><div class="error">Incorrect Password! <br> Hint: bsis2</div></div>';
                }
            } else {
                echo '<div class="errorContainer"><div class="error">User Not Found!</div></div>';
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebAppDev2 - Midtern Project</title>
    <link rel="stylesheet" href="ind.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Honk&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="title-container">
            <h1>WEB APP DEVELOPMENT 2</h1>
        </div>
     
        <form id="login-creds" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="userN">Username:</label>
            <input type="text" id="username" name ="username" placeholder="Type your username here:" required>
            <label for="passW">Password:</label>
            <input type="password" id="password" name ="password" placeholder="Type your password here:" required>
            <button id="submit">Log In</button>
        </form> 
        <p id="hint">password: bsis2</p>
    </div> 
</body>
</html>