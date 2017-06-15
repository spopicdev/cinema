<?php
/**
 * Created by PhpStorm.
 * User: Spopic
 * Date: 10-Jun-17
 * Time: 23:24
 */

function getIdSale($sediste, $connection)
{

    $SQL = "SELECT id_sala FROM sediste WHERE id_sedista='$sediste'";
    $result = mysqli_query($connection, $SQL);
    $record = mysqli_fetch_array($result);

    return $record['id_sala'];
}

function countReservations($connection, $id_proj)
{

    $SQL = "SELECT COUNT(id_rezervacija) FROM rezervacija WHERE id_prikazivanja='$id_proj'";
    $res = mysqli_query($connection, $SQL);
    $rec = mysqli_fetch_array($res);
    $count = $rec[0];
    return $count;
}


function countFreeSeats($connection, $id_sale)
{

    $SQL = "SELECT COUNT(id_sedista) FROM sediste WHERE zauzeto='0' AND id_sala='$id_sale'";
    $res = mysqli_query($connection, $SQL);
    $rec = mysqli_fetch_array($res);
    $count = $rec[0];
    return $count;
}

function countTakenSeats($connection)
{

    $SQL = "SELECT COUNT(id_sedista) FROM sediste WHERE zauzeto=1";
    $res = mysqli_query($connection, $SQL);
    $rec = mysqli_fetch_array($res);
    $count = $rec[0];
    echo $count;
}

function moviesProjecting($connection)
{


    $SQL = "SELECT COUNT(id_projekcija) FROM projekcija";
    $res = mysqli_query($connection, $SQL);
    $rec = mysqli_fetch_array($res);
    $count = $rec[0];
    echo $count;

}

function isTaken($idSeat,$connection)
{

    $SQL = "SELECT COUNT(id_sedista) FROM sediste WHERE zauzeto=0";
    $res = mysqli_query($connection, $SQL);
    $rec = mysqli_fetch_array($res);
    $count = $rec[0];
    echo $count;

}

function loadMovies($page, $limit) {
    global $connection;

    $page = (int) $page;
    $limit = (int) $limit;

    $offset = 0;
    if ($page > 1) {
        $offset = ($page - 1) * $limit;
    }

    $sql = "SELECT naslov,opis,emitujeDo FROM film ORDER BY `emitujeDo` DESC LIMIT $offset, $limit";
    $results = mysqli_query($connection,$sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($results)>0) {
        while ($record = mysqli_fetch_array($results,MYSQLI_ASSOC)) {
            $data[] = $record;
        }
    }

    $query = "SELECT COUNT(id_film) as movie_count FROM film";
    $result = mysqli_query($connection, $query);
    $row   = mysqli_fetch_row($result);
    $totalCount = $row[0];

    $nextPage = $page + 1;

    if($totalCount - ($page * $limit) <= 0) {
        $nextPage = null;
    }

    $return = [
        'next_page' => $nextPage,
        'movies' => $data
    ];
    return $return;

}