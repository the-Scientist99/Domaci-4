<?php
// Provjera da li korisnik pristupa preko POST metode ako nije šaljemo ga na početnu stranicu
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Provjera da li je korisnik unio ime, prezime, grad i želju, ako nije šaljemo ga nazad na početnu stranu
    // uz poruku da popuni sve tražene podatke
    if (
        !isset($_POST['ime']) || !isset($_POST['prezime']) ||
        !(isset($_POST['grad']) && $_POST['grad'] != "") ||
        !(isset($_POST['zelja']) && $_POST['zelja'] != "")
    ) {
        header('location: ./index.html?msg=error');
    } else {
        // Dodeljujemo promenljivim vrijednosti iz forme radi lakše manipulacije
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $grad = $_POST['grad'];
        $zelja = $_POST['zelja'];

        // Provjeravamo da li se ime i prezime sastoje isključivo od slova
        if (!(preg_match('/[^A-Ža-ž]/', $ime) || preg_match('/[^A-Ža-ž]/', $prezime))) {
            // Provjeravamo da li je korisnik čekirao checkbox
            isset($_POST['dbr_zao']) ? $dobar = "Dobar" : $dobar = "Zao";

            // Pozivamo funkciju koja skladišti podatke i preusmjerava nas na zelja_poslata.html
            sacuvajZelju($ime, $prezime, $grad, $zelja, $dobar);
            header('location: ./zelja_poslata.html');
        } else {
            header('location: ./index.html?msg=error');
        }
    }
} else {
    header('location: ./index.html');
}

// Funkcija kreira novi .txt fajl i smješta u njemu podatke u JSON formatu
function sacuvajZelju($ime, $prezime, $grad, $zelja, $dobar)
{
    $db_folder = "./zelje_db";
    // Provjera da li dati fajl postoji, ako ne postoji kreira ga
    if (!file_exists($db_folder)) {
        mkdir($db_folder);
    }
    $file_name = uniqid();
    // Kreiramo novi fajl sa jedinstvenim imenom i kreiramo asocijativni niz
    $h = fopen($db_folder . "/" . $file_name . ".txt", "a+") or die("Unable to open file!");
    $arr = [
        'ime' => $ime, 'prezime' => $prezime, 'grad' => $grad, 'dobar' => $dobar, 'zelja' => $zelja
    ];
    // Enkodujemo asocijativni niz u JSON format i upisujemo u .txt fajl nakon čega zatvaramo fajl
    $json_format = json_encode($arr);
    fwrite($h, $json_format);
    fclose($h);
}
