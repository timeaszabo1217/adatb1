<?php
require_once('db.php');
$conn = connect();

if (isset($_SESSION['operátor_id'])) {
    $operatorId = $_SESSION['operátor_id'];

    $stmt = $conn->prepare("SELECT bejelentkezett FROM Operátorok WHERE operátor_id = ?");
    $stmt->bind_param("i", $operatorId);
    $stmt->execute();
    $result = $stmt->get_result();

    $isLoggedIn = isset($row['bejelentkezett']) && $row['bejelentkezett'] == 1;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $newLoggedInValue = $isLoggedIn ? 0 : 1;
        $updateStmt = $conn->prepare("UPDATE Operátorok SET bejelentkezett = ? WHERE operátor_id = ?");
        $updateStmt->bind_param("ii", $newLoggedInValue, $operatorId);
        $updateStmt->execute();
        $updateStmt->close();
        $isLoggedIn = true;
    } else {
        $isLoggedIn = false;
    }
} else {
    $isLoggedIn = false;
}
?>

<nav class="navbar user-select-none">
    <a href="index.php" class="navbar-item">Kezdőlap</a>
    <?php if ($isLoggedIn): ?>
        <a href="meresi_adat.php" class="navbar-item">Mérési adatok</a>
        <a href="meroallomas.php" class="navbar-item">Mérőállomások</a>
        <a href="meromuszer.php" class="navbar-item">Mérőműszerek</a>
    <?php endif; ?>
    <div class="navbar-item dropdown profileIcon right-side">
        <img class="right-side user-select-none" src="assets/img/profile_icon.png" alt="Profil ikon">
        <div class="dropdown-content">
            <?php if ($isLoggedIn): ?>
                <a href="kijelentkezes.php" class="navbar-item">Kijelentkezés</a>
            <?php else: ?>
                <a href="regisztracio.php" class="navbar-item">Regisztráció</a>
                <a href="bejelentkezes.php" class="navbar-item">Bejelentkezés</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
