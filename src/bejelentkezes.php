<?php
session_start();
require_once('db.php');
$conn = connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM Operátorok WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($result->num_rows == 1 && password_verify($password, $row['jelszó'])) {
        $_SESSION['operátor_id'] = $row['operátor_id'];
        $_SESSION['bejelentkezett'] = true;

        echo "<script>
        setTimeout(function() {
            document.getElementById('message').style.display = 'none';
            window.location.href = 'index.php';
        }, 2000);
    </script>";
        echo "<div id='message' style='display: block; position: absolute; top: calc(50% - 290px); left: 50%; transform: translateX(-50%); background-color: rgba(240, 240, 240, 0.8); padding: 15px; border: 1px solid #ccc; border-radius: 8px; z-index: 9999;'>Sikeres bejelentkezés!</div>";
    } else {
        echo "<div id='message' style='display: block; position: absolute; top: calc(50% - 290px); left: 50%; transform: translateX(-50%); background-color: rgb(193,90,90); padding: 15px; border: 1px solid #c15a5a; border-radius: 8px; z-index: 9999;'>Hibás felhasználónév vagy jelszó!</div>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="hu">
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
    <h1>Bejelentkezés</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br>

        <label for="password">Jelszó:</label>
        <input type="password" name="password" id="password"><br>

        <input class="btn-primary" type="submit" value="Bejelentkezés">
    </form>
</main>
<footer>
    <?php require 'footer.php'; ?>
</footer>
</body>
</html>
