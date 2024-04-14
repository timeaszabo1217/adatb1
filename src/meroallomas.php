<?php
session_start();
require_once('db.php');

if (isset($_SESSION['bejelentkezett']) && $_SESSION['bejelentkezett'] === true) {
    $conn = connect();
    if ($conn->connect_error) {
        die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
    }

    if (isset($_POST['action']) && $_POST['action'] === 'Állomás felvétele' && $_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = connect();
        $telepules = $_POST['település'];
        $varmegye = $_POST['vármegye'];
        $helyNeve = $_POST['hely_neve'];

        $stmt = $conn->prepare("INSERT INTO Mérőállomások (település, vármegye, hely_neve) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $telepules, $varmegye, $helyNeve);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Mérőállomás sikeresen hozzáadva.";
        } else {
            $_SESSION['error_message'] = "Hiba történt a mérőállomás hozzáadása során.";
        }
        $stmt->close();
        $conn->close();
        header("Location: meroallomas.php");
        exit();
    }
    if (isset($_POST['action']) && $_POST['action'] === 'Állomás törlése' && $_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = connect();
        if (isset($_POST['hely_neve'])) {
            $helyNeve = $_POST['hely_neve'];

            $stmt_hely = $conn->prepare("SELECT hely_id FROM Mérőállomások WHERE hely_neve = ?");
            $stmt_hely->bind_param("s", $helyNeve);
            $stmt_hely->execute();
            $result = $stmt_hely->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $helyId = $row['hely_id'];

                $deleteMeresiStmt = $conn->prepare("DELETE FROM Mérőműszer_Helyek WHERE hely_id = ?");
                $deleteMeresiStmt->bind_param("i", $helyId);
                if ($deleteMeresiStmt->execute()) {
                    $_SESSION['success_message'] = "Mérőműszerek sikeresen eltávolítva az állomástól.";
                } else {
                    $_SESSION['error_message'] = "Hiba történt a mérőműszerek eltávolítása során.";
                }
                $deleteMeresiStmt->close();

                $deleteOperatorStmt = $conn->prepare("DELETE FROM Operátor_helyek WHERE hely_id = ?");
                $deleteOperatorStmt->bind_param("i", $helyId);
                if ($deleteOperatorStmt->execute()) {
                    $_SESSION['success_message'] = "Operátorok sikeresen eltávolítva az állomástól.";
                } else {
                    $_SESSION['error_message'] = "Hiba történt az operátorok eltávolítása során.";
                }
                $deleteOperatorStmt->close();
            }

            $stmt = $conn->prepare("DELETE FROM Mérőállomások WHERE hely_neve = ?");
            $stmt->bind_param("s", $helyNeve);

            if ($stmt->execute()) {
                echo "";
            } else {
                echo "Hiba a Mérőállomás törlése közben: " . $stmt->error;
            }
            $stmt->close();
            $conn->close();
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'Operátor hozzáadása' && $_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = connect();
        $operatorId = $_POST['operátor_id'];
        $helyId = $_POST['hely_id'];

        $checkStmt = $conn->prepare("SELECT * FROM Operátor_Helyek WHERE operátor_id = ? AND hely_id = ?");
        $checkStmt->bind_param("ii", $operatorId, $helyId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        $deleteStmt = $conn->prepare("DELETE FROM Operátor_Helyek WHERE operátor_id = ?");
        $deleteStmt->bind_param("i", $operatorId);

        if ($deleteStmt->execute()) {
            $_SESSION['success_message'] = "Operátor sikeresen eltávolítva az állomástól.";
        } else {
            $_SESSION['error_message'] = "Hiba történt az operátor eltávolítása során.";
        }
        $deleteStmt->close();

        if($helyId === "") {
            $checkStmt->close();
            $conn->close();
            header("Location: meroallomas.php");
            exit();
        }
        $insertStmt = $conn->prepare("INSERT INTO Operátor_Helyek (operátor_id, hely_id) VALUES (?, ?)");
        $insertStmt->bind_param("ii", $operatorId, $helyId);

        if ($insertStmt->execute()) {
            $_SESSION['success_message'] = "Operátor sikeresen hozzárendelve az állomáshoz.";
        } else {
            $_SESSION['error_message'] = "Hiba történt az operátor hozzárendelése során.";
        }
        $insertStmt->close();
        $checkStmt->close();
        $conn->close();
        header("Location: meroallomas.php");
        exit();
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
    <?php require 'header.php'; ?>
</header>
<main>
    <h1>Mérőállomások listája</h1>
    <?php
    $conn = connect();
    $stmt = $conn->prepare("SELECT Mérőállomások.település, Mérőállomások.vármegye, Mérőállomások.hely_neve, 
            COUNT(Mérőműszer_Helyek.műszer_id) AS mérőműszerek_száma,
            IFNULL(GROUP_CONCAT(CONCAT(Operátorok.név, ' (', Operátorok.email, ')') SEPARATOR '<br>'), '-') AS operátorok
            FROM Mérőállomások
            LEFT JOIN Mérőműszer_Helyek ON Mérőállomások.hely_id = Mérőműszer_Helyek.hely_id
            LEFT JOIN Operátor_helyek ON Mérőállomások.hely_id = Operátor_helyek.hely_id
            LEFT JOIN Operátorok ON Operátorok.operátor_id = Operátor_helyek.operátor_id
            GROUP BY Mérőállomások.vármegye");

    if ($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            echo "<table>";
            echo "<thead>
                <tr>
                    <th>Település</th>
                    <th>Vármegye</th>
                    <th>Hely</th>
                    <th>Mérőműszerek száma</th>
                    <th>Operátorok</th>
                </tr>
              </thead>
              <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['település'] . "</td>";
                echo "<td>" . $row['vármegye'] . "</td>";
                echo "<td>" . $row['hely_neve'] . "</td>";
                echo "<td>" . $row['mérőműszerek_száma'] . "</td>";
                echo "<td>" . $row['operátorok'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        }
        else {
            echo "Nincsenek adatok az adatbázisban.";
        }
    }
    else {
        echo "Hiba történt a lekérdezés előkészítésekor: " . $conn->error;
    }
    $lastMonthMissingData = $conn->query("SELECT Mérőállomások.hely_neve, Mérőállomások.település, Mérőállomások.vármegye
    FROM Mérőállomások
    WHERE Mérőállomások.hely_id NOT IN (
        SELECT DISTINCT hely_id
        FROM Mérési_adatok
        WHERE MONTH(időpont) = MONTH(NOW() - INTERVAL 1 MONTH) 
        AND YEAR(időpont) = YEAR(NOW() - INTERVAL 1 MONTH)
    )"
    );

    if ($lastMonthMissingData && $lastMonthMissingData->num_rows > 0) {
        echo "<p>Ezek az állomások nem szolgáltattak adatokat az elmúlt hónapban:</p>";
        echo "<table>";
        echo "<thead>
        <tr>
            <th>Település</th>
            <th>Vármegye</th>
            <th>Hely</th>
        </tr>
      </thead>
      <tbody>";

        while ($row = $lastMonthMissingData->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['település'] . "</td>";
            echo "<td>" . $row['vármegye'] . "</td>";
            echo "<td>" . $row['hely_neve'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
        $conn->close();
    } else {
        echo "<p>Nincs hiányzó adat az elmúlt hónapban.</p>";
    }
    ?>
    <h1>Mérőállomás felvétele</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="település">Település:</label>
        <input type="text" id="település" name="település"><br>

        <label for="vármegye">Vármegye:</label>
        <input type="text" id="vármegye" name="vármegye"><br>

        <label for="hely_neve">Hely neve:</label>
        <input type="text" id="hely_neve" name="hely_neve"><br>

        <input class="btn-primary" type="submit" name="action" value="Állomás felvétele">
    </form>
    <h1>Mérőállomás törlése</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="hely_neve">Törlendő állomás:</label>
        <select id="hely_neve" name="hely_neve">
            <?php
            $conn = connect();
            $stmt = $conn->prepare("SELECT hely_id, település, vármegye, hely_neve FROM Mérőállomások");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $helyInfo = $row['település'] . ', ' . $row['vármegye'] . ', ' . $row['hely_neve'];
                echo "<option value='" . $row['hely_neve'] . "'>" . $helyInfo . "</option>";
            }
            $conn->close();
            ?>
        </select><br>

        <input class="btn-primary" type="submit" name="action" value="Állomás törlése">
    </form>
    <h1>Operátor hozzárendelése állomáshoz</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="operátor">Hozzáadandó operátor:</label>
        <select name="operátor_id" id="operátor">
            <?php
            $conn = connect();
            $stmt = $conn->prepare("SELECT operátor_id, név, email FROM Operátorok");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $operatorInfo = $row['név'] . ' (' . $row['email'] . ')';
                echo "<option value='" . $row['operátor_id'] . "'>" . $operatorInfo . "</option>";
            }
            $conn->close();
            ?>
        </select><br>

        <label for="hely_id">Állomás:</label>
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

        <input class="btn-primary" type="submit" name="action" value="Operátor hozzáadása">
    </form>
</main>
<footer>
    <?php require 'footer.php'; ?>
</footer>
</body>
</html>
