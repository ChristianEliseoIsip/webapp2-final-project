<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cp.css">
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Honk&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
</head>
<body>
    <div class="contentContainer">
        <div id="content">
        <?php

        require 'config.php';

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit;
        }

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
            $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            if ($pdo) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $query = "SELECT * FROM `posts` WHERE id = :id";
                    $statement = $pdo->prepare($query);
                    $statement->execute([':id' => $id]);

                    $post = $statement->fetch(PDO::FETCH_ASSOC);

                    if ($post) {
                        echo '<h1 class="game">GAME ' . $post['id'] . '</h1>';
                        echo '<h3 class="gameTitle"> ' . $post['title'] . '</h3>';
                        echo '<p class="gameBody"> ➡️' . $post['body'] . '</p>';
                    } else {
                        echo "ID $id not found!";
                    }
                } else {
                    echo "No post ID provided!";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
        </div>
        <button id="backButton">Back to Titles</button>
    </div>
</body>
<script>
    //Back Button to Main Page
    document.getElementById("backButton").addEventListener("click", () => {
        window.location.href = "mainPage.php";
    });
</script>
</html>