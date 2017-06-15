<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reservation</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/customScrips.js"></script>
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

        .row.content {height: 450px}


        .sidenav-left {
            padding-top: 20px;
            height: 100%;

        }

        .sidenav-right {
            padding-top: 20px;
            height: 100%;

        }


        @media screen and (max-width: 767px) {
            .sidenav-left {
                height: auto;
                padding: 15px;
            }
            .sidenav-right {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;}


        }
        @media (max-width: 1200px) {
            .seats{
                display: none;
            }

            .seatsSelect{
                display: block;
                background-color: #3c3c3c;
                border-radius: 15px;
                opacity: 0.9;
            }
        }
        .seats{
            background-color: #3c3c3c;
            border-radius: 15px;
            opacity: 0.9;
        }

        .resInfo{
            color: #fff;
            background-color: #3c3c3c;
            opacity: 0.9;
            border-radius: 15px;
            margin-top: 10px;
            padding-top: 10px;
        }


    </style>
</head>
<body>

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
    </div>
</nav>
<!-- end of navbar -->

<div class="container-fluid text-center reservationCont">
    <div class="row content">
        <div class="col-sm-2 sidenav-left side-marg-left"></div>
        <div class="col-sm-8 text-center">
            <div class="resInfo">

            <h2>Reservation</h2><br/>
            <h3>Please fill in informations to reserve you'r ticket/s</h3><br/>
                <h4>One person can reserve up to 6 tickets</h4>
                <br/>
            </div>
            <hr>
            <form class="form" method="post" action="reserve.php">
                <div class="form-group">
                    <select name="movies" class="form-control" ">
                        <option value="default">- Choose a movie -</option>
                        <?php
                        require 'db_config.php';
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
                            $option .= '<option value="' . $id_film . '">' . $film_naziv . '</option>';
                        }
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
                <p class="ticketsErrOver" hidden style="color: white; font-size: 16px">Please select 6 seats or less.</p>
                <p class="ticketsErrUnder" hidden style="color: white; font-size: 16px">Please select at least one ticket</p>
                <div class="form-group">
                    <input type="number" class="tickets form-control" placeholder="No. of tickets" required>
                </div>
                <p class="seatsErr" hidden style="color: white; font-size: 16px">Please select different seats</p>
                <div class="seatsSelect1 form-group" hidden>
                        <select class="seats1 form-control">
                            <option value="default"> -Choose seat- </option>
                            <?php
                            $row=4;
                            $seat=12;
                            $seatFree=true;
                            for($i=0; $i<$row; $i++){
                                for($j=0; $j<$seat; $j++){
                                    $id=$i*$seat+$j;
                                    if($seatFree){
                                        echo '<option value="'.$id.'">row: '.($i+1).', seat: '.($j+1).'</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                <div class="seatsSelect2 form-group" hidden>
                    <select class="seats2 form-control">
                        <option value="default"> -Choose seat- </option>
                        <?php
                        $row=4;
                        $seat=12;
                        $seatFree=true;
                        for($i=0; $i<$row; $i++){
                            for($j=0; $j<$seat; $j++){
                                $id=$i*$seat+$j;
                                if($seatFree){
                                    echo '<option value="'.$id.'">row: '.($i+1).', seat: '.($j+1).'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="seatsSelect3 form-group" hidden>
                    <select class="seats3 form-control">
                        <option value="default"> -Choose seat- </option>
                        <?php
                        $row=4;
                        $seat=12;
                        $seatFree=true;
                        for($i=0; $i<$row; $i++){
                            for($j=0; $j<$seat; $j++){
                                $id=$i*$seat+$j;
                                if($seatFree){
                                    echo '<option value="'.$id.'">row: '.($i+1).', seat: '.($j+1).'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="seatsSelect4 form-group" hidden>
                    <select class="seats4 form-control">
                        <option value="default"> -Choose seat- </option>
                        <?php
                        $row=4;
                        $seat=12;
                        $seatFree=true;
                        for($i=0; $i<$row; $i++){
                            for($j=0; $j<$seat; $j++){
                                $id=$i*$seat+$j;
                                if($seatFree){
                                    echo '<option value="'.$id.'">row: '.($i+1).', seat: '.($j+1).'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="seatsSelect5 form-group" hidden>
                    <select class="seats5 form-control">
                        <option value="default"> -Choose seat- </option>
                        <?php
                        $row=4;
                        $seat=12;
                        $seatFree=true;
                        for($i=0; $i<$row; $i++){
                            for($j=0; $j<$seat; $j++){
                                $id=$i*$seat+$j;
                                if($seatFree){
                                    echo '<option value="'.$id.'">row: '.($i+1).', seat: '.($j+1).'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="seatsSelect6 form-group" hidden>
                    <select class="seats6 form-control">
                        <option value="default"> -Choose seat- </option>
                        <?php
                        $row=4;
                        $seat=12;
                        $seatFree=true;
                        for($i=0; $i<$row; $i++){
                            for($j=0; $j<$seat; $j++){
                                $id=$i*$seat+$j;
                                if($seatFree){
                                    echo '<option value="'.$id.'">row: '.($i+1).', seat: '.($j+1).'</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>

                <br/><br/>
<!--                <div class="seats"><br/><br/>-->
<!--                    --><?php
//                    $row=4;
//                    $seat=12;
//                    $seatFree=true;
//
//                    for($i=0; $i<$row; $i++){
//                    echo '<br/><div class="row">';
//                    for($j=0; $j<$seat; $j++){
//                        $id=$i*$seat+$j;
//                    if($seatFree){
//                        echo '<div class="free_seat col-md-1" id="'.$id.'"><img class="seatFree" src="resources/seat_free.png"></div>';
//                    }
//                    else{
//                       echo '<div class="col-md-1"><img src="resources/seat_taken.png"></div>';
//                    }
//                    };
//                    echo '</div>';
//                    }
//
//?>
<!--                    <br/>-->
<!--                </div>-->
                <br/><br/>
                <div class="form-group">
                    <button type="submit" class="btn-signin btn btn-primary btn-block">Reserve ticket</button>
                </div>
            </form>
        </div>
        <div class="col-sm-2 sidenav-right side-marg-right"></div>
    </div>

</div>

<div class="seatsSelect" style="display: none; color: #f9f9f9"><h1>asdasd</h1></div>
<script src="js/test.js"></script>
</body>
</html>