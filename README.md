# Adatbázisok 1

A projekt egy meteorológus weboldal készítése volt a feladat, kidolgozott adatbázissal (MySQL).

## Feladat szöveges leírása

A feladat egy meteorológiai weboldal készítése, amely MySQL adatbázist használ a mérési adatok tárolására. Az operátorok manuálisan viszik fel a hőmérsékletet és páratartalmat, és lekérdezhetik az adatokat hónapok, évszakok vagy évek szerint. Az oldal biztosítja a bejelentkezést, a jogosultságkezelést, valamint az adatok rögzítését és lekérdezését PHP és MySQL segítségével. A weboldal reszponzív, és grafikonokkal, táblázatokkal vizualizálja a mérési adatokat. Fontos a biztonságos adatkezelés és SQL injection védelem.

## Követelmények

### Tárolt adatok
- **Operátorok**:
  - operátor azonosító
  - egyedi email
  - jelszó
  - név
  - bejelentkezett státusz

- **Mérőműszerek**:
  - műszer azonosító
  - műszer megnevezése
  - típusa
  - modell szám
  - állapot (használatban, használaton kívül, javítás alatt)

- **Mérési helyek**:
  - mérőállomás neve
  - település
  - vármegye

- **Mérési adatok**:
  - ki végezte a mérést és az adatfelvitelt
  - melyik műszerrel történt a mérés
  - mért érték
  - mértékegység
  - mérés időpontja
  - mérés helye

### Adatbázis relációk
- Egy mérési helyen több mérőműszer található, de egy adott mérőműszer csak egy helyen van.
- Egy mérőműszerrel több időpontban is mérnek, és egy időpontban több mérőműszerrel is mérnek.
- Egy mérőhelyen több operátor dolgozik, de egy operátor csak egy mérőhelyen dolgozik.

### Backend működés
- **Adatbázis struktúra**: Az adatbázisban megfelelő táblák szükségesek az operátorok, mérőműszerek, mérési helyek és mérési adatok tárolására. Az adatokat PHP és MySQL segítségével kell kezelni.
  
- **Űrlapok és adatbevitel**: Az operátorok számára biztosítani kell egy egyszerű űrlapot, amely segítségével rögzíthetik a mért adatokat. A felvitt adatokat a rendszer elmenti az adatbázisba.

- **Lekérdezések**: Az operátorok képesek lesznek lekérdezni az adatokat hónapok, évszakok, vagy évek alapján.

- **Bejelentkezés és jogosultságkezelés**: Az operátorok számára szükséges egy bejelentkezési rendszer, amely biztosítja, hogy csak a megfelelő jogosultsággal rendelkező felhasználók férhetnek hozzá a mérési adatokhoz.

### Frontend működés
- **Felhasználói felület**: A felhasználók (operátorok) számára biztosítani kell egy egyszerű, átlátható és könnyen kezelhető űrlapot, amely segítségével rögzíthetik a mérési adatokat.
  
- **Reszponzív dizájn**: A weboldalnak mobil és asztali eszközökön egyaránt jól kell működnie. A frontend fejlesztéshez HTML5, CSS3 és JavaScript használata szükséges.

- **Vizualizáció**: A mérési adatok megjelenítése grafikonok, táblázatok vagy egyéb vizuális elemek segítségével.

### Biztonság
- **Adatvédelem**: A felhasználók személyes adatait biztonságosan kell tárolni, például a jelszavakat hashelve.
  
- **SQL injection védelem**: Az űrlapok és adatbázis lekérdezések biztonságos kezelésére különös figyelmet kell fordítani, hogy megakadályozzuk a támadásokat.

### Egyéb követelmények
- **Adatbázis-kezelés**: A mérési adatokat dinamikusan kell tárolni, és szükség van a rendszeres lekérdezésekre.
- **Interakciók kezelése**: Az operátorok számára biztosítani kell a megfelelő interakciókat az űrlapokon keresztül, például adatbevitel és lekérdezés.
