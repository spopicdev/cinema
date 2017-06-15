<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Admin login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
</head>
<body class="login-body">

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="login.php">Admin | Studentski Parlament</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="login-window">
    <h1 class="text-center"> Administrator <small>Bioskopa</small></h1>

    <form name="login" method="post" action="login_check.php" >

        <input type="text" name="username" placeholder="Unesite korisnicko ime" class="text-box" ><br>
        <input type="password" name="password" placeholder="Unesite lozinku" class="text-box" ><br>
        <input type="submit" name="submit" class="btn btn-danger login-button" value="Posalji" ><br>
        <input type="reset" name="reset" class="btn btn-secondary login-button" value="Otkazi">
        <span>  </span>
    </form>

</div>

<footer  class="bottom" id="footer" class="panel-footer">
    <p>Copyright BINGBOT, &copy; 2017</p>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</html>

