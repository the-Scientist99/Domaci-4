<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style3.css">
    <title>
        Sve Želje
    </title>
</head>

<body>
    <div class="container my-4">
        <h1 class="text-center">SPISAK SVIH ŽELJA</h1>
        <table class="table table-hover table-dark my-5">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Grad</th>
                    <th>Dobar / Zao</th>
                    <th>Želja</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $db_folder = "./zelje_db";
                // Sadržaj direktorijuma zelje_db smještamo u promenljivu $file_arr
                $file_arr = scandir($db_folder);

                foreach ($file_arr as $file) {
                    // Funkcija scandir() smješta i dva fajla "." i ".." koja sa sledećim if-om izbjegavamo
                    if ($file == "." || $file == "..") continue;

                    // Otvaramo fajl i njegov sadržaj iz JSON formata dekodiramo u niz
                    $my_file = fopen($db_folder . "/" . $file, "r") or die("Unable to open file!");
                    $contents = fread($my_file, filesize($db_folder . "/" . $file));
                    $arr = json_decode($contents, true);
                    fclose($my_file);
                    // Prolazimo kroz niz i kreiramo zasebne redove za svaku želju zasebno
                    echo "<tr class='text-center'>";
                    foreach ($arr as $val) {
                        echo "<td>$val</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>