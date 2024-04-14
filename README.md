# Adatbázisok

Egy meteorológus weboldal készítése a feladat, kidolgozott adatbázissal (MySQL).

## Specifikáció
Egy adatbázisban tároljuk az egyes mérőállomásokon lévő műszerek által mért adatokat. Régi műszerek vannak, ezért még nem tudnak adatot küldeni az adatbázisba. A hőmérsékleti és páratartalom értékeket az operátorok viszik fel az adatbázisba külön űrlapon. Az operátorok egyúttal le is tudják kérdezni az adatokat, hónapra, évszakra, évre vonatkozóan.
- Tárolt adatok:
Operátorok: operátor azonosító, egyedi email, jelszó, név, bejelentkezett
Mérőműszerek: műszer azonosító, műszer megnevezése, típusa, modell szám, állapot (használatban, használaton kívül, javítás alatt)
Mérési hely: mérőállomás neve, település, vármegye
Mérési adatok: ki végezte a mérést és az adatfelvitelt, melyik műszerrel történt a mérés, mi a mért érték, mi a mennyiségi egység, mikor történt a mérés, hol történt a mérés
- Relációk az adatok között:
Egy mérési helyen több mérőműszer található, de egy adott mérőműszer csak egy helyen van. Egy mérőműszerrel több időpontban is mérnek és egy időpontban több mérőműszerrel is mérnek (egyszerre olvassa le az operátor a két értéket, majd egyenként felviszi azokat). Egy mérőhelyen több operátor dolgozik, de egy operátor csak egy mérőhelyen dolgozik.

```plaintext
                   へ  ♡   ╱|、 
              ૮  >  <)     (˚ˎ 。7
              / ⁻  ៸|       |、˜〵       
           乀(ˍ, ل ل        じしˍ,)ノ
```
