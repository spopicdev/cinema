<?php

require 'functions.php';
include 'db_config.php';

$pageNum = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$page = mysqli_real_escape_string($connection, $pageNum);
$limit = 3;

$results = loadMovies($page, $limit);
$output = '';

if(isset($results['movies']) && $results['movies']) {
    foreach($results['movies'] as $movies) {
        $output .= 'asd';
    }
}

echo $output;
if($results['next_page']) {
    echo '<button type="button" class="load-movies btn-primary" data-page="'.$results['next_page'].'">Load movies</button>';
}