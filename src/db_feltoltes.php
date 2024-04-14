<?php
require_once('db.php');
$conn = connect();

if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}

//function generatePassword() {
//    $length = 10;
//    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//    $password = '';
//
//    for ($i = 0; $i < $length - 1; $i++) {
//        $password .= $chars[rand(0, strlen($chars) - 1)];
//    }
//    $password .= rand(0, 9);
//
//    return $password;
//}

$operators = [
    ['email' => 'john@example.com', 'password' => 'johnpassword', 'name' => 'John Doe'],
    ['email' => 'jane@example.com', 'password' => 'janepassword', 'name' => 'Jane Smith'],
    ['email' => 'alice@example.com', 'password' => 'alicepassword', 'name' => 'Alice Johnson'],
    ['email' => 'bob@example.com', 'password' => 'bobpassword', 'name' => 'Bob Jackson'],
    ['email' => 'emma@example.com', 'password' => 'emmapassword', 'name' => 'Emma Thompson'],
    ['email' => 'william@example.com', 'password' => 'williampassword', 'name' => 'William Morris'],
    ['email' => 'olivia@example.com', 'password' => 'oliviapassword', 'name' => 'Olivia Cook'],
    ['email' => 'michael@example.com', 'password' => 'michaelpassword', 'name' => 'Michael Jenkins'],
    ['email' => 'sophia@example.com', 'password' => 'sophiapassword', 'name' => 'Sophia Rogers'],
    ['email' => 'daniel@example.com', 'password' => 'danielpassword', 'name' => 'Daniel Griffin'],
    ['email' => 'oliver@example.com', 'password' => 'oliverpassword', 'name' => 'Oliver Hall'],
    ['email' => 'amelia@example.com', 'password' => 'ameliapassword', 'name' => 'Amelia Watson'],
    ['email' => 'ethan@example.com', 'password' => 'ethanpassword', 'name' => 'Ethan Ward'],
    ['email' => 'ava@example.com', 'password' => 'avapassword', 'name' => 'Ava Brooks'],
    ['email' => 'noah@example.com', 'password' => 'noahpassword', 'name' => 'Noah Turner'],
    ['email' => 'charlotte@example.com', 'password' => 'charlottepassword', 'name' => 'Charlotte Harris'],
    ['email' => 'james@example.com', 'password' => 'jamespassword', 'name' => 'James Murphy'],
    ['email' => 'isabella@example.com', 'password' => 'isabellapassword', 'name' => 'Isabella King'],
    ['email' => 'logan@example.com', 'password' => 'loganpassword', 'name' => 'Logan Scott'],
    ['email' => 'mia@example.com', 'password' => 'miapassword', 'name' => 'Mia Adams'],
    ['email' => 'alexander@example.com', 'password' => 'alexanderpassword', 'name' => 'Alexander Clarke'],
    ['email' => 'grace@example.com', 'password' => 'gracepassword', 'name' => 'Grace Allen'],
    ['email' => 'lucas@example.com', 'password' => 'lucaspassword', 'name' => 'Lucas Carter'],
    ['email' => 'aubrey@example.com', 'password' => 'aubreypassword', 'name' => 'Aubrey Morgan'],
    ['email' => 'hannah@example.com', 'password' => 'hannahpassword', 'name' => 'Hannah Morris']
];


$instruments = [
    ['típus' => 'Hőmérő', 'modell_szám' => 'T-1000', 'állapot' => 'használatban', 'műszer_neve' => 'Hőmérő 1'],
    ['típus' => 'Csapadékmérő', 'modell_szám' => 'RainSense-200', 'állapot' => 'használaton kívül', 'műszer_neve' => 'Csapadékmérő 1'],
    ['típus' => 'Szélsebességmérő', 'modell_szám' => 'WindMaster-5000', 'állapot' => 'javítás alatt', 'műszer_neve' => 'Szélsebességmérő 1'],
    ['típus' => 'Felhőzetmérő', 'modell_szám' => 'CloudSense-300', 'állapot' => 'használatban', 'műszer_neve' => 'Felhőzetmérő 1'],
    ['típus' => 'Légnyomásmérő', 'modell_szám' => 'PressurePro-700', 'állapot' => 'használaton kívül', 'műszer_neve' => 'Légnyomásmérő 1'],
    ['típus' => 'Hőmérő', 'modell_szám' => 'T-1001', 'állapot' => 'használatban', 'műszer_neve' => 'Hőmérő 2'],
    ['típus' => 'Csapadékmérő', 'modell_szám' => 'RainSense-201', 'állapot' => 'javítás alatt', 'műszer_neve' => 'Csapadékmérő 2'],
    ['típus' => 'Szélsebességmérő', 'modell_szám' => 'WindMaster-5001', 'állapot' => 'használaton kívül', 'műszer_neve' => 'Szélsebességmérő 2'],
    ['típus' => 'Felhőzetmérő', 'modell_szám' => 'CloudSense-301', 'állapot' => 'használatban', 'műszer_neve' => 'Felhőzetmérő 2'],
    ['típus' => 'Légnyomásmérő', 'modell_szám' => 'PressurePro-701', 'állapot' => 'javítás alatt', 'műszer_neve' => 'Légnyomásmérő 2'],
    ['típus' => 'Hőmérő', 'modell_szám' => 'T-1002', 'állapot' => 'javítás alatt', 'műszer_neve' => 'Hőmérő 3'],
    ['típus' => 'Csapadékmérő', 'modell_szám' => 'RainSense-202', 'állapot' => 'használatban', 'műszer_neve' => 'Csapadékmérő 3'],
];

$places = [
    ['település' => 'Budapest', 'vármegye' => 'Pest', 'hely_neve' => 'Belváros'],
    ['település' => 'Debrecen', 'vármegye' => 'Hajdú-Bihar', 'hely_neve' => 'Újváros'],
    ['település' => 'Győr', 'vármegye' => 'Győr-Moson-Sopron', 'hely_neve' => 'Központ'],
    ['település' => 'Miskolc', 'vármegye' => 'Borsod-Abaúj-Zemplén', 'hely_neve' => 'Alsóváros'],
    ['település' => 'Pécs', 'vármegye' => 'Baranya', 'hely_neve' => 'Felsőváros'],
    ['település' => 'Szeged', 'vármegye' => 'Csongrád', 'hely_neve' => 'Felsőváros'],
];

$monthData = [];

for ($month = 1; $month <= 12; $month++) {
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, 2023);

    $measurementsCount = rand(3, 5);

    for ($i = 0; $i < $measurementsCount; $i++) {
        $randomDay = rand(1, $daysInMonth);
        $randomDate = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $randomDay, 2023));
        $randomMeasurement = rand(2, 22);

        $monthData[$month][] = [
            'érték' => $randomMeasurement,
            'egység' => '°C',
            'időpont' => $randomDate,
        ];
    }
}

// SOROK HOZZÁADÁSA AZ ADATBÁZISBÓL

//foreach ($operators as $operator) {
//    $username = $operator['username'];
//    $email = $operator['email'];
//    $password = generatePassword();
//    $name = $operator['name'];
//
//    if (strlen($password) >= 8 && preg_match('/[0-9]/', $password)) {
//        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//
//        $stmt = "INSERT INTO operátorok (felhasználónév, email, jelszó, név, bejelentkezett) VALUES ('$username', '$email', '$hashed_password', '$name', 0)";
//
//        if ($conn->query($stmt) === TRUE) {
//            echo "Adatok sikeresen feltöltve az adatbázisba: $username<br>";
//        } else {
//            echo "Hiba az adatfeltöltés során: " . $conn->error . "<br>";
//        }
//    } else {
//        echo "Hibás jelszó formátum a(z) $username felhasználónál. A jelszónak legalább 8 karakter hosszúnak kell lennie és tartalmaznia kell legalább egy számot.<br>";
//    }
//}
//
//foreach ($instruments as $instrument) {
//    $tipus = $instrument['típus'];
//    $modell_szam = $instrument['modell_szám'];
//    $allapot = $instrument['állapot'];
//    $muszer_neve = $instrument['műszer_neve'];
//
//    $stmt = "INSERT INTO mérőműszerek (típus, modell_szám, állapot, műszer_neve) VALUES ('$tipus', '$modell_szam', '$allapot', '$muszer_neve')";
//
//    if ($conn->query($stmt) === TRUE) {
//        echo "Adatok sikeresen feltöltve az adatbázisba: $muszer_neve<br>";
//    } else {
//        echo "Hiba az adatfeltöltés során: " . $conn->error . "<br>";
//    }
//}
//
//foreach ($places as $place) {
//    $telepules = $place['település'];
//    $varmegye = $place['vármegye'];
//    $hely_neve = $place['hely_neve'];
//
//    $stmt = "INSERT INTO mérőállomások (település, vármegye, hely_neve) VALUES ('$telepules', '$varmegye', '$hely_neve')";
//
//    if ($conn->query($stmt) === TRUE) {
//        echo "Adatok sikeresen feltöltve az adatbázisba: $telepules<br>";
//    } else {
//        echo "Hiba az adatfeltöltés során: " . $conn->error . "<br>";
//    }
//}
//
//foreach ($instruments as $instrument) {
//    if ($instrument['állapot'] === 'használatban') {
//        $muszerNev = $instrument['műszer_neve'];
//
//        $stmtInstrument = $conn->prepare("SELECT műszer_id FROM mérőműszerek WHERE műszer_neve = ?");
//        $stmtInstrument->bind_param("s", $muszerNev);
//        $stmtInstrument->execute();
//        $resultInstrument = $stmtInstrument->get_result();
//        $rowInstrument = $resultInstrument->fetch_assoc();
//        $muszerId = $rowInstrument['műszer_id'];
//        $stmtInstrument->close();
//
//        $stmtCheckAssignment = $conn->prepare("SELECT COUNT(*) as count FROM mérőműszer_helyek WHERE műszer_id = ?");
//        $stmtCheckAssignment->bind_param("i", $muszerId);
//        $stmtCheckAssignment->execute();
//        $resultCheckAssignment = $stmtCheckAssignment->get_result();
//        $rowCheckAssignment = $resultCheckAssignment->fetch_assoc();
//        $count = $rowCheckAssignment['count'];
//        $stmtCheckAssignment->close();
//
//        if ($count === 0) {
//            foreach ($places as $place) {
//                $telepules = $place['település'];
//                $varmegye = $place['vármegye'];
//                $helyNeve = $place['hely_neve'];
//
//                $stmtPlace = $conn->prepare("SELECT hely_id FROM mérőállomások WHERE település = ? AND vármegye = ? AND hely_neve = ?");
//                $stmtPlace->bind_param("sss", $telepules, $varmegye, $helyNeve);
//                $stmtPlace->execute();
//                $resultPlace = $stmtPlace->get_result();
//                $rowPlace = $resultPlace->fetch_assoc();
//                $helyId = $rowPlace['hely_id'];
//                $stmtPlace->close();
//
//                $stmtCheckAssignment = $conn->prepare("SELECT COUNT(*) as count FROM mérőműszer_helyek WHERE hely_id = ?");
//                $stmtCheckAssignment->bind_param("i", $helyId);
//                $stmtCheckAssignment->execute();
//                $resultCheckAssignment = $stmtCheckAssignment->get_result();
//                $rowCheckAssignment = $resultCheckAssignment->fetch_assoc();
//                $assignedCount = $rowCheckAssignment['count'];
//                $stmtCheckAssignment->close();
//
//                if ($assignedCount === 0) {
//                    $stmtInsert = $conn->prepare("INSERT INTO mérőműszer_helyek (hely_id, műszer_id) VALUES (?, ?)");
//                    $stmtInsert->bind_param("ii", $helyId, $muszerId);
//
//                    if ($stmtInsert->execute()) {
//                        echo "Adatok sikeresen feltöltve az adatbázisba: $muszerId, $helyId<br>";
//                        break;
//                    } else {
//                        echo "Hiba az adatfeltöltés során: " . $stmtInsert->error . "<br>";
//                    }
//                    $stmtInsert->close();
//                }
//            }
//        } else {
//            echo "A műszer már rendelve van egy helyhez.<br>";
//        }
//    }
//}

//$műszer_id = rand(33, 43);
//$operátor_id = rand(5, 23);
//$hely_id = rand(8, 13);
//
//foreach ($monthData as $month => $measurements) {
//    foreach ($measurements as $data) {
//        $value = $data['érték'];
//        $unit = $data['egység'];
//        $timestamp = $data['időpont'];
//
//        $műszer_id = rand(33, 43);
//        $operátor_id = rand(5, 23);
//        $hely_id = rand(8, 13);
//
//        $stmt = "INSERT INTO mérési_adatok (érték, egység, időpont, műszer_id, operátor_id, hely_id)
//                VALUES ('$value', '$unit', '$timestamp', '$műszer_id', '$operátor_id', '$hely_id')";
//
//        if ($conn->query($stmt) === TRUE) {
//            echo "Sikeresen hozzáadva: érték = $value, egység = $unit, időpont = $timestamp a(z) $month. hónapban<br>";
//        } else {
//            echo "Hiba a hozzáadás során: " . $conn->error;
//        }
//    }
//}

// SOROK TÖRLÉSE AZ ADATBÁZISBÓL

//foreach ($operators as $operator) {
//    $username = $operator['username'];
//    $email = $operator['email'];
//    $password = generatePassword();
//    $name = $operator['name'];
//
//    if (strlen($password) >= 8 && preg_match('/[0-9]/', $password)) {
//        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//
//        $stmt = "DELETE FROM operátorok WHERE operátorok.operátor_id > 23";
//
//        if ($conn->query($stmt) === TRUE) {
//            echo "Adatok sikeresen feltöltve az adatbázisba: $username<br>";
//        } else {
//            echo "Hiba az adatfeltöltés során: " . $conn->error . "<br>";
//        }
//    } else {
//        echo "Hibás jelszó formátum a(z) $username felhasználónál. A jelszónak legalább 8 karakter hosszúnak kell lennie és tartalmaznia kell legalább egy számot.<br>";
//    }
//}

//foreach ($instruments as $instrument) {
//    $tipus = $instrument['típus'];
//    $modell_szam = $instrument['modell_szám'];
//    $allapot = $instrument['állapot'];
//    $muszer_neve = $instrument['műszer_neve'];
//
//    $stmt = "DELETE FROM mérőműszerek WHERE műszer_id > 44";
//
//    if ($conn->query($stmt) === TRUE) {
//        echo "Adatok sikeresen feltöltve az adatbázisba: $muszer_neve<br>";
//    } else {
//        echo "Hiba az adatfeltöltés során: " . $conn->error . "<br>";
//    }
//}

//foreach ($places as $place) {
//    $telepules = $place['település'];
//    $varmegye = $place['vármegye'];
//    $hely_neve = $place['hely_neve'];
//
//    $stmt = "DELETE FROM mérőállomások WHERE mérőállomások.hely_id > 13";
//
//    if ($conn->query($stmt) === TRUE) {
//        echo "Adatok sikeresen feltöltve az adatbázisba: $telepules<br>";
//    } else {
//        echo "Hiba az adatfeltöltés során: " . $conn->error . "<br>";
//    }
//}

//$stmt = "DELETE FROM mérési_adatok";
//
//if ($conn->query($stmt) === TRUE) {
//    echo "Az összes adat sikeresen törölve a táblából.";
//} else {
//    echo "Hiba a törlés során: " . $conn->error;
//}

$conn->close();