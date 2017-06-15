<?php
/**
 * Created by PhpStorm.
 * User: Spopic
 * Date: 10-Jun-17
 * Time: 23:14
 */
include('db_config.php');

$ime='Test Rezervacija';
$id_projekcije=1;
$id_tip_rezervacije=9;
$count_mesta=3;
$placeno=0;
$arr=array(155,156,157);
$SQL0="call rezervacijaTransaction('$id_projekcije','$id_tip_rezervacije','$ime', '$placeno')";
$SQL1="SELECT id_rezervacija FROM rezervacija where nosilac_rezervacije='$ime'";
mysqli_query($connection, $SQL0) or die(mysqli_error($connection));
$result = mysqli_query($connection, $SQL1) or die(mysqli_error($connection));
$record = mysqli_fetch_array($result);
$id_rezervacije=$record['id_rezervacija'];

foreach ($arr as $item) {
    $id_sale=3;
    $SQL2="INSERT INTO `rezervisano_mesto` (`id_rezervisano`, `id_sediste`, `id_rezervacija`, `id_projekcija`) 
                        VALUES (NULL, '$item', '$id_rezervacije', '$id_projekcije') ";
    mysqli_query($connection, $SQL2) or die(mysqli_error($connection));
    $SQL3="UPDATE `sediste` SET `zauzeto` = '1' WHERE `sediste`.`id_sedista` = $item";
    mysqli_query($connection, $SQL3) or die(mysqli_error($connection));
}


