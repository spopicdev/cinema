<?php
include('session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('functions.php');
          include('db_config.php'); ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cinema">
    <meta name="author" content="Bingbot">

    <title>Admin page</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script>
        $(document).ready(function()
        {
            $(".delproj").click(function()
            {
                var del_id = $(this).attr('id');
                $.ajax({
                    type:'POST',
                    url:'remove_projection.php',
                    data:'delete_id='+del_id,
                    success: function(data)
                    {
                        alert("successfuly deleted");
                    }
                });
            });
        });

    </script>
</head>

<body>
<form id="forma">
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php">Bioskop admin</a>
            </div>
            <ul class="nav navbar-right top-nav">


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Administrator <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                                                <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Unos <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dodaj film</a>
                            </li>
                            <li>
                                <a href="#">Unesi rezervaciju</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                    <?php
                    $SQL="SELECT * FROM projekcija";
                    $res=mysqli_query($connection, $SQL);
                    $zanrovii="";
                    $zanrovi="";
                    $mesta_arr=array();
                    $free_mesta="";
                    $arr=array();
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
                        $broj_rezervacija=countReservations($connection, $id_proj);
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

                        echo <<<EOD
                        
                        
                    <div class="row">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                 $film_naziv <small>Na listi</small>
                            </h1>
                        </div>
                        
                    </div>


                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">$sala_br_slobodnih </div>
                                        <div>Preostale karte</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Detaljnije</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix">
                                    </div>
                                    
                                </div>
                            </a>
                            <table class="table-responsive progress-striped table"> <tr> <td>Cena:</td><td>$film_cena RSD</td></tr>
                                    <tr> <td>Trajanje:</td><td>$film_trajanje min</td></tr>
                                    <tr> <td>Opis:</td><td>$film_opis</td></tr>
                                    <tr> <td>Zanr:</td><td>$zanrovi</td></tr>

                                    </table>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa fa-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">$broj_rezervacija</div>
                                        <div>Broj rezervacija</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Detaljnije</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <table class="table-responsive progress-striped table"> <tr> <td>Slobodna mesta:</td><td>$free_mesta</td></tr>
                                   

                                    </table>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa  fa-film fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">$sala_naziv</div>
                                        <div>Sala</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Detaljnije</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <h2> $trenutno_projektuje</h2>
                        </div>
                    </div>



                </div> 
                <button type="button" class="delproj btn btn-danger btn-lg" data-toggle="modal" id="$id_proj"> Delete projection </button>

                <hr>

EOD;
$zanrovii="";
$zanrovi="";
$free_mesta="";

 }

?>



            </div>


        </div>


    </div>



    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
    </div>

</form>

</body>

</html>


