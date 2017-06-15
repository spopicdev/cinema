<!DOCTYPE html>
<html lang="en">
<head>
    <title>Movies</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/ajaxScript"></script>
    <style>
        body{
            background-image: url(background.jpg);
            background-size:cover;
           min-height: 100%;
            font-family: 'Orbitron', sans-serif;
        }
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }
        footer {
            background-color: #f2f2f2;
            padding: 25px;
        }
        .carousel-inner img {
            width: 100%;
            margin: auto;
            min-height:200px;
        }

        @media (max-width: 600px) {
            .carousel-caption {
                display: none;
            }
            .Mcont{
                margin-top: 10px;
            }
        }


        .Mtitle{
            color: #fff;
        }

        .Mcont{
            padding-left: 10px;
            padding-right: 10px;
            color: #fff;

        }

        .mcc{
            background-color: #3c3c3c;
            opacity: 0.9;
            border-radius: 15px;
            border: 2px solid black;
        }

        .footer{
            font-size: 15px;
            background-color: transparent;
            color: #f9f9f9;
        }

    </style>
</head>
<body>
<?php
require ('db_config.php');
include ('functions.php');
$option="";
$SQL="SELECT * FROM projekcija";
$res=mysqli_query($connection, $SQL);
$zanrovii="";
$zanrovi="";
$mesta_arr=array();
$free_mesta="";
$arr=array();
$data="";
while ($rec=mysqli_fetch_array($res)) {
$id_proj = $rec['id_projekcija'];
$id_film = $rec['id_film'];
$id_sala = $rec['id_sala'];
$poc_proj =strtotime($rec['pocetak_projekcije']);
$SQL1 = "SELECT * FROM sala WHERE id_sale=$id_sala";
$res1 = mysqli_query($connection, $SQL1);
$rec1 = mysqli_fetch_array($res1);
$sala_naziv = $rec1['naziv'];
$sala_br_mesta = $rec1['broj_mesta'];

$sala_br_slobodnih = countFreeSeats($connection, $id_sala);
$SQL2 = "SELECT * FROM film WHERE id_film=$id_film";
$res2 = mysqli_query($connection, $SQL2);
$rec2 = mysqli_fetch_array($res2);
$film_naziv = $rec2['naslov'];
$film_opis = $rec2['opis'];
$film_trajanje = ($rec2['trajanje']);
$film_emitujeDo = strtotime($rec2['emitujeDo']);
$film_cena=$rec2['cena'];
$film_image = $rec2['imageLocation'];
    $SQL3="SELECT z.naziv_zanra FROM zanr z, film_zanr fz WHERE z.id_zanr in (SELECT fzz.zanr_id_zanr from film_zanr fzz WHERE fzz.film_id_film=$id_film)";
    $res3 = mysqli_query($connection, $SQL3);
    while ($rec3 = mysqli_fetch_array($res3)){
        array_push($arr, $rec3['naziv_zanra']);
    };
    $arr2=array_unique($arr);
    foreach ($arr2 as $x)
        $zanrovii.=$x.', ';
    $zanrovi=rtrim($zanrovii,", ");

    $SQL4="SELECT mesto from sediste where zauzeto='0' AND id_sala=$id_sala";
    $res4 = mysqli_query($connection, $SQL4);
    while ($rec4 = mysqli_fetch_array($res4)){
        array_push($mesta_arr, $rec4['mesto']);
    }
    $mesta_arr=array_unique($mesta_arr);
    foreach ($mesta_arr as $item) {
        $free_mesta.=$item.', ';
    }

    $free_mesta=rtrim($free_mesta,", ");
    $timeproj=$poc_proj+$film_trajanje*60;
    if (strtotime(time())>$poc_proj and time()<$timeproj)
        $trenutno_projektuje="Trenutno se projektuje";
    else
        $trenutno_projektuje="Trenutno se ne projektuje";


            $option.= '<option value="'.$id_film.'">'.$film_naziv.'</option>';




    $data.= <<<EOD
        <div class="col-sm-4 Mcont">
            <div class="mcc">
            <h2 class="$">$film_naziv</h2><br/>
            <img src="resources/$film_image" class="img-responsive" style="width:100%" alt="Image"><br/>
            <button type="button" class=" btn btn-info btn-lg"  ><a class="btn" href="reservation.php">Reserve ticket</a></button>
            <br/><br/>
            <table class="table-responsive progress-striped table"> <tr> <td>Cena:</td><td>$film_cena RSD</td></tr>
                                    <tr> <td>Trajanje:</td><td>$film_trajanje min</td></tr>
                                    <tr> <td>Opis:</td><td>$film_opis</td></tr>
                                    <tr> <td>Zanr:</td><td>$zanrovi</td></tr>

                                    </table>
            </div>
        </div>

EOD;

    $zanrovii="";
    $zanrovi="";
    $free_mesta="";

}
?>

<!-- start of navbar -->
<nav class="navbar navbar-default navbar-inverse" role="navigation">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="movies.php"><img src="resources/logo3.png"></a>
        </div>


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Fast reserve</b> <span class="caret"></span></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form" method="post" action="login.php" id="login-nav">
                                        <div class="form-group">
                                            <select name="movies" class="form-control" ">
                                            <option value="default">- Choose a movie -</option>
                                            <?php
                                            echo $option;
                                             ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email address" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First and last name" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Phone number" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="No. of tickets" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn-signin btn btn-primary btn-block">Reserve ticket</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- end of navbar -->

<!-- start of carousel -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="resources/strange.jpg" alt="Image">
            <div class="carousel-caption">
                <h1>Dr. Strange</h1>
                <p>Opis filma...</p>
            </div>
        </div>

        <div class="item">
            <img src="resources/pirati.jpg" alt="Image">
            <div class="carousel-caption">
                <h1>Pirati sa kariba</h1>
                <p>Opis filma...</p>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- end of carousel -->


<div class="container text-center">
    <hr>
    <h1 style="color: #f9f9f9; font-size: 42px; font-weight: bold">Movies</h1>
    <hr>
    <div class="row">
<!--        <div class="col-sm-4 Mcont">-->
<!--            <div class="mcc">-->
<!--            <h2 class="Mtitle">Movie1</h2><br/>-->
<!--            <img src="resources/noMovie.jpg" class="img-responsive" style="width:100%" alt="Image"><br/>-->
<!--            <button type="button" class=" btn btn-info btn-lg" data-toggle="modal" data-target="#infoModal">More Info</button>-->
<!--            <br/><br/>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-sm-4 Mcont">-->
<!--            <div class="mcc">-->
<!--            <h2 class="Mtitle">Movie1</h2><br/>-->
<!--            <img src="resources/noMovie.jpg" class="img-responsive" style="width:100%" alt="Image"><br/>-->
<!--            <button type="button" class=" btn btn-info btn-lg" data-toggle="modal" data-target="#infoModal">More Info</button>-->
<!--            <br/><br/>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-sm-4 Mcont">-->
<!--            <div class="mcc">-->
<!--            <h2 class="Mtitle">Movie1</h2><br/>-->
<!--            <img src="resources/noMovie.jpg" class="img-responsive" style="width:100%" alt="Image"><br/>-->
<!--            <button type="button" class=" btn btn-info btn-lg" data-toggle="modal" data-target="#infoModal">More Info</button>-->
<!--            <br/><br/>-->
<!--            </div>-->
<!--        </div>-->
        <?php echo $data; ?>
    </div>
    <br/><br/>
    <div class="content">
        <button type="button" class="load-movies btn-primary" data-page="1">Load movies</button>
    </div>
</div><br>


<br/><br/><br/>
<footer class="container-fluid text-center footer">
    <p>Copyright by BINGBOT</p>
    <p>Subotica, 2017.</p>
</footer>

<div id="infoModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Movie name</h4>
            </div>
            <div class="modal-body">
                <p>Movie description</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#reserveModal">reserve</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="reserveModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Movie name</h4>
            </div>
            <div class="modal-body">
                <form class="form" method="post" action="reserve.php">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email address" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First and last name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone number" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="No. of tickets" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-signin btn btn-primary btn-block">Reserve ticket</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Reserve!</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>

</body>
</html>