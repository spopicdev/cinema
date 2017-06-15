<?php
/**
 * Created by PhpStorm.
 * User: Spopic
 * Date: 13-Jun-17
 * Time: 17:04
 */
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "cinema");

global $connection;
$connection = mysqli_connect(HOST, USER, PASSWORD, DB);

$name = "Ko to tamo peva";
$producent = "Trkulja";
$glumci = "Bata Stojkovic, Cutura, i ostali";
$opis = "Jugoslovenski domaci film";
$trajanje = "111";
$format = "2D";
$slika = "/image.jpg";
$emitujeDo = date('d-m-y');
$zanr = array('zanr1', 'zanr2', 'zanr3');
$temp = array();
global $temp;

//$SQL1="INSERT INTO `film` (`id_film`, `naslov`, `producent`, `glumci`, `opis`, `trajanje`, `format_snimka`, `cena`, `emitujeDo`, `imageLocation`) VALUES
//(NULL,'$name', '$producent', '$glumci','$opis','$trajanje','$format', 250, '$emitujeDo', '$slika')";
//$result0=mysqli_query($connection, $SQL1);
//var_dump($result0);

temploop:
$SQL2 = "SELECT id_zanr, naziv_zanra FROM zanr";
$result = mysqli_query($connection, $SQL2);

while ($record = mysqli_fetch_array($result)) {
//     var_dump($record);
    array_push($temp, array('id_zanr' => $record['id_zanr'], 'naziv_zanra' => $record['naziv_zanra']));
}


$SQL4 = "SELECT id_film FROM film f WHERE f.naslov='$name'";
$result2 = mysqli_query($connection, $SQL4);
$record2 = mysqli_fetch_array($result2);
$movieAddedId = $record2['id_film'];


foreach ($temp as $item2) {

    foreach ($zanr as $item) {
        if (!(array_search($item, $item2))) {
            $tempGenreName = $item;
            $SQL6 = "SELECT id_zanr FROM zanr WHERE naziv_zanra='$tempGenreName'";
            $result3 = mysqli_query($connection, $SQL6);
            $record3 = mysqli_fetch_array($result3);
            $tempGenreId = $record3['id_zanr'];
            if ($tempGenreId == null) {
                $SQL3 = "INSERT INTO zanr(naziv_zanra) VALUES ('$tempGenreName')";
                mysqli_query($connection, $SQL3);
                $SQL6 = "SELECT id_zanr FROM zanr WHERE naziv_zanra='$tempGenreName'";
                $result3 = mysqli_query($connection, $SQL6);
                $record3 = mysqli_fetch_array($result3);
                $tempGenreId = $record3['id_zanr'];
                array_push($temp, array('id_zanr' => $tempGenreId, 'naziv_zanra' => $tempGenreName));
                $SQL5 = "INSERT INTO film_zanr(film_id_film, zanr_id_zanr) VALUES  ('$movieAddedId','$tempGenreId')";
                mysqli_query($connection, $SQL5);
            }
        } else {
            $SQL6 = "SELECT id_zanr FROM zanr WHERE naziv_zanra='$tempGenreName'";
            $result3 = mysqli_query($connection, $SQL6);
            $record3 = mysqli_fetch_array($result3);
            $tempGenreId = $record3['id_zanr'];
            $SQL5 = "INSERT INTO film_zanr(film_id_film, zanr_id_zanr) VALUES  ('$movieAddedId','$tempGenreId')";
            $result4 = mysqli_query($connection, $SQL5);

        }


    }
}
