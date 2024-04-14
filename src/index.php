<?php
session_start();
require_once('db.php');
$conn = connect();
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <title>Meteorológia</title>
    <link rel="icon" href="favicon.ico?">
    <meta name = "viewport" content = "width-device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/stlye.css">
    <link rel = "stylesheet" href = "css/menu.css">
</head>
<body>
<header>
    <?php
    require 'header.php';
    ?>
</header>
<main>
    <?php
    if (isset($_SESSION['operátor_id'])) {
        $operatorId = $_SESSION['operátor_id'];
        $stmt = $conn->prepare("SELECT név FROM Operátorok WHERE operátor_id = ?");
        $stmt->bind_param("i", $operatorId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userName = $row['név'];
            echo "<h1>Üdvözöllek, $userName!</h1>";
            echo "<div class='kitty-container'>
                <img src='assets/img/umbrellakitty.png' id='umbrellakitty' alt='umbrellakitty'>
                </div>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<h1>Kedves operátor!</h1>";
        echo "<p>Kérlek jelentkezz be, vagy ha még nem tetted, regisztrálj.</p>";
    }
    ?>
</main>
<footer>
    <?php require 'footer.php'; ?>
</footer>
</body>
</html>
