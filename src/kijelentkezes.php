<?php
session_start();
require_once('db.php');

$conn = connect();
$operatorId = $_SESSION['operátor_id'];
$stmt = $conn->prepare("UPDATE operátorok SET bejelentkezett = 0 WHERE operátor_id = ?");
$stmt->bind_param("i", $operatorId);
$stmt->execute();

//if ($stmt->affected_rows > 0) {
//    echo "Az adatbázis frissítése sikeres volt.";
//} else {
//    echo "Hiba az adatbázis frissítése közben: " . $conn->error;
//}
$stmt->close();
$conn->close();

session_unset();
session_destroy();
echo "<script>
        setTimeout(function() {
            document.getElementById('message').style.display = 'none';
            window.location.href = 'bejelentkezes.php';
        }, 2000);
    </script>";
echo "<div id='message' style='display: block; position: absolute; top: calc(50% - 290px); left: 50%; transform: translateX(-50%); background-color: rgba(240, 240, 240, 0.8); padding: 15px; border: 1px solid #ccc; border-radius: 8px; z-index: 9999;'>Sikeres kijelentkezés!</div>";
exit();
