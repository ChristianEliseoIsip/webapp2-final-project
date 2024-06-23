<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mp.css">
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Honk&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
</head>
<body>

    <div class="welcome-container">
        <h1>WELCOME</h1>
        <p>CHOOSE YOUR GAME!</p>
        <button id="backButton">Log Out</button>
    </div>

    <div class="title-container">
        <h1>GAME TITLES:</h1>
        <ul id="titles">
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
                $user_id = $_SESSION['user_id'];

                $query = "SELECT * FROM `posts` WHERE user_id = :id";
                $statement = $pdo->prepare($query);
                $statement->execute([':id' => $user_id]);

                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

                $is_last = false;
                foreach ($rows as $key => $row) {
                    if ($key === count($rows) - 1) {
                        $is_last = true;
                    }
                    echo '<li' . ($is_last ? ' class="last-item"' : '') . '><a href="contentPage.php?id=' . $row['id'] . '">' . $row['title'] . '</a></li>';
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
        </ul>
    </div>
</body>
<script>
    //logout button
    document.getElementById("backButton").addEventListener("click", () => {
        savingOverlay();
        setTimeout(() => {
            window.location.href = "logout.php";
        }, 11500); 
        
    });
    //logout screen
    function savingOverlay() {

        const savingContainer = document.createElement("div");
        savingContainer.className = "saving";

        const savingText = document.createElement("h1");
        savingText.textContent = "Logging Out...";

        const img = document.createElement("img");
        img.src = "anime.webp";
        img.alt = "Loading"; 

        savingContainer.appendChild(img);
        savingContainer.appendChild(savingText);
        document.body.appendChild(savingContainer);
    }
</script>
</html>