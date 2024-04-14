<?php
require_once('db.php');
$conn = connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $name = $_POST['name'];

    if (strlen($password) < 8 || !preg_match('/[0-9]/', $password)) {
        echo "<div id='message' style='display: block; position: absolute; top: calc(50% - 375px); left: 50%; transform: translateX(-50%); background-color: rgb(193,90,90); padding: 15px; border: 1px solid #c15a5a; border-radius: 8px; z-index: 9999;'>A jelszónak legalább 8 karakter hosszúnak és legalább egy számot tartalmazó kell lennie!</div>";
    } elseif ($password !== $confirm_password) {
        echo "<div id='message' style='display: block; position: absolute; top: calc(50% - 375px); left: 50%; transform: translateX(-50%); background-color: rgb(193,90,90); padding: 15px; border: 1px solid #c15a5a; border-radius: 8px; z-index: 9999;'>A megadott jelszavak nem egyeznek!</div>";
    } else {
        $check_email_query = "SELECT * FROM Operátorok WHERE email = '$email'";
        $result = mysqli_query($conn, $check_email_query);
        if (mysqli_num_rows($result) > 0) {
            echo "<div id='message' style='display: block; position: absolute; top: calc(50% - 375px); left: 50%; transform: translateX(-50%); background-color: rgb(193,90,90); padding: 15px; border: 1px solid #c15a5a; border-radius: 8px; z-index: 9999;'>Ez az email már cím foglalt!</div>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO Operátorok (email, jelszó, név) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $hashed_password, $name);

            if ($stmt->execute()) {
                echo "<script>
        setTimeout(function() {
            document.getElementById('message').style.display = 'none';
            window.location.href = 'bejelentkezes.php';
        }, 2000);
    </script>";
                echo "<div id='message' style='display: block; position: absolute; top: calc(50% - 375px); left: 50%; transform: translateX(-50%); background-color: rgba(240, 240, 240, 0.8); padding: 15px; border: 1px solid #ccc; border-radius: 8px; z-index: 9999;'>Sikeres regisztráció!</div>";
            } else {
                echo "<div id='message' style='display: block; position: absolute; top: calc(50% - 375px); left: 50%; transform: translateX(-50%); background-color: rgb(193,90,90); padding: 15px; border: 1px solid #c15a5a; border-radius: 8px; z-index: 9999;'>Hiba a regisztráció során:  . $conn->error</div>";
            }
            $stmt->close();
        }
    }
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
    <h1>Regisztráció</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Név:</label>
        <input type="text" name="name" id="name"><br>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email"><br>

        <label for="password">Jelszó:</label>
        <input type="password" name="password" id="password"><br>

        <label for="confirm_password">Jelszó újra:</label>
        <input type="password" name="confirm_password" id="confirm_password"><br>

        <input class="btn-primary" type="submit" value="Regisztráció">
    </form>
</main>
<footer>
    <?php require 'footer.php'; ?>
</footer>
</body>
</html>
