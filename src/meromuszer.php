<?php
session_start();
require_once('db.php');

if (isset($_SESSION['bejelentkezett']) && $_SESSION['bejelentkezett'] === true) {
    $conn = connect();
    if ($conn->connect_error) {
        die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
    }

    if(isset($_POST['action']) && $_POST['action'] === 'Műszer felvétele' && $_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = connect();
        $muszerNeve = $_POST['műszer_neve'];
        $tipus = $_POST['típus'];
        $modellSzam = $_POST['modell_szám'];
        $allapot = $_POST['állapot'];

        $stmt = $conn->prepare("INSERT INTO Mérőműszerek (típus, modell_szám, állapot, műszer_neve) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $tipus, $modellSzam, $allapot, $muszerNeve);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Mérőműszer sikeresen felvéve az adatbázisba.";
        } else {
            $_SESSION['error_message'] = "Hiba történt a művelet során.";
        }
        $stmt->close();
        $conn->close();
        header("Location: meromuszer.php");
        exit();
    }
    if(isset($_POST['action']) && $_POST['action'] === 'Műszer módosítása' && $_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = connect();
        $muszerNev = $_POST['műszer_neve'];
        $allapot = $_POST['állapot'];
        $helyId = $_POST['hely_id'];

        $stmt_muszerek = $conn->prepare("SELECT műszer_id FROM Mérőműszerek WHERE műszer_neve = ?");
        $stmt_muszerek->bind_param("s", $muszerNev);
        $stmt_muszerek->execute();
        $result = $stmt_muszerek->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $muszerId = $row['műszer_id'];

            $deleteStmt = $conn->prepare("DELETE FROM Mérőműszer_Helyek WHERE műszer_id = ?");
            $deleteStmt->bind_param("i", $muszerId);
            $deleteStmt->execute();
            $deleteStmt->close();

            if($helyId !== "") {
                $checkStmt = $conn->prepare("SELECT hely_id FROM Mérőállomások WHERE hely_id = ?");
                $checkStmt->bind_param("i", $helyId);
                $checkStmt->execute();
                $checkResult = $checkStmt->get_result();

                if ($checkResult->num_rows > 0) {
                    $stmt_hely = $conn->prepare("INSERT INTO Mérőműszer_Helyek (hely_id, műszer_id) VALUES (?, ?)");
                    $stmt_hely->bind_param("ii", $helyId, $muszerId);
                    $stmt_hely->execute();
                    $stmt_hely->close();
                } else {
                    $_SESSION['error_message'] = "Hibás hely azonosító.";
                }
            }
            $stmt_muszer = $conn->prepare("UPDATE Mérőműszerek SET állapot = ? WHERE műszer_id = ?");
            $stmt_muszer->bind_param("si", $allapot, $muszerId);
            $stmt_muszer->execute();
            $stmt_muszer->close();

            $_SESSION['success_message'] = "Műszer sikeresen módosítva.";
        } else {
            $_SESSION['error_message'] = "Nem található műszer ezzel a névvel.";
        }
        $conn->close();

        header("Location: meromuszer.php");
        exit();
    }
    if (isset($_POST['action']) && $_POST['action'] === 'Műszer törlése' && $_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = connect();
        $muszerNev = $_POST['műszer_neve'];

        $stmt_muszerek = $conn->prepare("SELECT műszer_id FROM Mérőműszerek WHERE műszer_neve = ?");
        $stmt_muszerek->bind_param("s", $muszerNev);
        $stmt_muszerek->execute();
        $result = $stmt_muszerek->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $muszerId = $row['műszer_id'];

            $checkStmt = $conn->prepare("SELECT * FROM Mérőműszer_Helyek WHERE hely_id = ? AND műszer_id = ?");
            $checkStmt->bind_param("ii", $helyId, $muszerId);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            $deleteStmt = $conn->prepare("DELETE FROM Mérőműszer_Helyek WHERE műszer_id = ?");
            $deleteStmt->bind_param("i", $muszerId);

            if ($deleteStmt->execute()) {
                $_SESSION['success_message'] = "Eszköz sikeresen eltávolítva.";
            } else {
                $_SESSION['error_message'] = "Hiba történt az eszköz eltávolítása során.";
            }
            $deleteStmt->close();
        }

        $stmt = $conn->prepare("DELETE FROM Mérőműszerek WHERE műszer_neve = ?");
        $stmt->bind_param("s", $muszerNev);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Mérőműszer sikeresen törölve.";
        } else {
            $_SESSION['error_message'] = "Hiba történt a mérőműszer törlése során.";
        }
        $stmt->close();
        $conn->close();
        header("Location: meromuszer.php");
        exit();
    }
} else {
    header("Location: bejelentkezes.php");
    exit();
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
        <?php require 'header.php'; ?>
    </header>
    <main>
        <h1>Mérőműszerek listája</h1>
        <table>
            <thead>
            <tr>
                <th>Műszer neve</th>
                <th>Típus</th>
                <th>Modell szám</th>
                <th>Állapot</th>
                <th>Mérőállomás</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $conn = connect();
            $stmt = "SELECT Mérőműszerek.műszer_neve, típus, modell_szám, mérőműszerek.állapot, 
       IFNULL(GROUP_CONCAT(CONCAT(Mérőállomások.település, ', ', Mérőállomások.vármegye, ', ', Mérőállomások.hely_neve) SEPARATOR '<br>'), '-') AS mérőállomások
        FROM Mérőműszerek
        LEFT JOIN Mérőműszer_Helyek ON Mérőműszerek.műszer_id = Mérőműszer_Helyek.műszer_id
        LEFT JOIN Mérőállomások ON Mérőállomások.hely_id = Mérőműszer_Helyek.hely_id
        GROUP BY Mérőműszerek.műszer_neve";

            $result = $conn->query($stmt);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['műszer_neve'] . "</td>";
                    echo "<td>" . $row['típus'] . "</td>";
                    echo "<td>" . $row['modell_szám'] . "</td>";
                    echo "<td>" . $row['állapot'] . "</td>";
                    echo "<td>" . $row['mérőállomások'] . "</td>";
                    echo "</tr>";
                }
                $conn->close();
            } else {
                echo "Nincsenek adatok az adatbázisban.";
            }
            ?>
            </tbody>
        </table>
        <h1>Mérőműszer felvétele</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="műszer_neve">Mérőműszer neve:</label>
            <input type="text" id="műszer_neve" name="műszer_neve"><br>

            <label for="típus">Típus:</label>
            <input type="text" id="típus" name="típus"><br>

            <label for="modell_szám">Modellszám:</label>
            <input type="text" id="modell_szám" name="modell_szám"><br>

            <label for="állapot">Állapot:</label>
            <select id="állapot" name="állapot">
                <option value="használatban">használatban</option>
                <option value="használaton kívül">használaton kívül</option>
                <option value="javítás alatt">javítás alatt</option>
            </select><br>

            <input class="btn-primary" type="submit" name="action" value="Műszer felvétele">
        </form>
        <h1>Mérőműszer módosítása</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="műszer_neve">Mérőműszer neve:</label>
            <input type="text" id="műszer_neve" name="műszer_neve"><br>

            <label for="állapot">Új állapot:</label>
            <select id="állapot" name="állapot">
                <option value="használatban">használatban</option>
                <option value="használaton kívül">használaton kívül</option>
                <option value="javítás alatt">javítás alatt</option>
            </select><br>

            <label for="hely_id">Új hely:</label>
            <select id="hely_id" name="hely_id">
                <option value="">(üres)</option>
                <?php
                $conn = connect();
                $stmt = $conn->prepare("SELECT hely_id, település, vármegye, hely_neve FROM Mérőállomások");
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $helyInfo = $row['település'] . ', ' . $row['vármegye'] . ', ' . $row['hely_neve'];
                    echo "<option value='" . $row['hely_id'] . "'>" . $helyInfo . "</option>";
                }
                $conn->close();
                ?>
            </select><br>

            <input class="btn-primary" type="submit" name="action" value="Műszer módosítása">
        </form>
        <h1>Mérőműszer törlése</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="műszer_neve">Mérőműszer neve:</label>
            <input type="text" id="műszer_neve" name="műszer_neve"><br>

            <input class="btn-primary" type="submit" name="action" value="Műszer törlése">
        </form>
    </main>
    <footer>
        <?php require 'footer.php'; ?>
    </footer>
</body>
</html>

