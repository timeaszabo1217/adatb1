<?php
session_start();
require_once('db.php');

$tableContent = "";
$selectedCounty = "";

if (isset($_SESSION['bejelentkezett']) && $_SESSION['bejelentkezett'] === true) {
    $conn = connect();
    if ($conn->connect_error) {
        die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
    }

    if (isset($_POST['action']) && $_POST['action'] === 'Szűrés' && $_SERVER["REQUEST_METHOD"] == "POST") {
        $varmegye = $_POST['hely_id'];
        $selectedCounty = $varmegye;

        if ($selectedCounty === "Országos") {
            $stmt = $conn->prepare("SELECT MIN(Mérési_adatok.érték) AS min_ertek, MAX(Mérési_adatok.érték) AS max_ertek, 
            ROUND(AVG(Mérési_adatok.érték), 1) AS avg_ertek, Mérési_adatok.egység, MONTH(Mérési_adatok.időpont) AS month_num
            FROM Mérési_adatok
            GROUP BY MONTH(Mérési_adatok.időpont)");
        } else {
            $stmt = $conn->prepare("SELECT MIN(Mérési_adatok.érték) AS min_ertek, MAX(Mérési_adatok.érték) AS max_ertek, 
            ROUND(AVG(Mérési_adatok.érték), 1) AS avg_ertek, Mérési_adatok.egység, MONTH(Mérési_adatok.időpont) AS month_num
            FROM Mérési_adatok
            JOIN Mérőállomások mérőállomások ON mérési_adatok.hely_id = Mérőállomások.hely_id
            WHERE Mérőállomások.vármegye = ?
            GROUP BY MONTH(Mérési_adatok.időpont)");

            $stmt->bind_param("s", $varmegye);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $tableContent = '<table>';
            $tableContent .= '<tr><th>Hónap</th><th>Minimum</th><th>Maximum</th><th>Átlag</th></tr>';

            while ($row = $result->fetch_assoc()) {
                $unit = $row['egység'];
                $minValue = isset($row['min_ertek']) ? $row['min_ertek'] . ' ' . $unit : '-';
                $maxValue = isset($row['max_ertek']) ? $row['max_ertek'] . ' ' . $unit : '-';
                $avgValue = isset($row['avg_ertek']) ? round($row['avg_ertek'], 1) . ' ' . $unit : '-';

                $monthNumber = $row['month_num'];
                $months = [
                    '1' => 'Január',
                    '2' => 'Február',
                    '3' => 'Március',
                    '4' => 'Április',
                    '5' => 'Május',
                    '6' => 'Június',
                    '7' => 'Július',
                    '8' => 'Augusztus',
                    '9' => 'Szeptember',
                    '10' => 'Október',
                    '11' => 'November',
                    '12' => 'December'
                ];
                $monthName = $months[$monthNumber];

                $tableContent .= "<tr><td>$monthName</td><td>$minValue</td><td>$maxValue</td><td>$avgValue</td></tr>";
            }
            $tableContent .= '</table>';
        } else {
            $tableContent = 'Nincs adat a kiválasztott vármegyére.';
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
    <?php require 'header.php'; ?>
</header>
<main>
    <h1>Hőmérsékleti adatok</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="hely_id">Térség:</label>
        <select id="hely_id" name="hely_id">
            <option value="Országos">Országos</option>
            <?php
            $conn = connect();
            $stmt = $conn->prepare("SELECT DISTINCT vármegye FROM Mérőállomások");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $county = $row['vármegye'];
                echo "<option value='" . $county . "'>" . $county . "</option>";
            }
            ?>
        </select><br>
        <input class="btn-primary" type="submit" name="action" value="Szűrés"></form><br>
    <?php
    if (!empty($selectedCounty) && $selectedCounty !== "Országos") {
        echo "<p>$selectedCounty vármegye</p>";
    }
    else if (!empty($selectedCounty)){
        echo "<p>Országos</p>";
    }
    echo $tableContent;

    $stmt = $conn->prepare("SELECT Operátorok.operátor_id, Operátorok.név AS operátor_neve, CONCAT(Mérőállomások.település, ', ', Mérőállomások.vármegye, ', ', Mérőállomások.hely_neve) AS hely_neve, 
            COUNT(Mérési_adatok.operátor_id) AS adatok_száma
            FROM Mérési_adatok
            LEFT JOIN Operátorok ON Mérési_adatok.operátor_id = Operátorok.operátor_id
            LEFT JOIN Mérőállomások ON Mérési_adatok.hely_id = Mérőállomások.hely_id
            GROUP BY Mérési_adatok.operátor_id, Mérőállomások.hely_id");

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        echo '<h1>Felvitt adatok a mai napon (' . date("Y.m.d") . ')</h1>';
        echo '<table>';
        echo '<tr><th>Operátor azonosítója</th><th>Operátor neve</th><th>Mérőállomás neve</th><th>Felvitt adatok száma</th></tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['operátor_id'] . '</td>';
            echo '<td>' . $row['operátor_neve'] . '</td>';
            echo '<td>' . $row['hely_neve'] . '</td>';
            echo '<td>' . $row['adatok_száma'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "<p>A mai napon nem volt még adat feltöltés.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
</main>
<footer>
    <?php require 'footer.php'; ?>
</footer>
</body>
</html>
