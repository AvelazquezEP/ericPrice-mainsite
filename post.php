<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2024 05:00:00 GMT"); //Update before 26/Jul/2024
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$host = "abogadoericprice.com";
$port = "5432";
$dbname = "dbezl1uquldojv";
$user = "uhgpgzxv2hhak";
$password = "700Flower!";

$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string) or die('Could not reach database.');

$id_post = $_SERVER['QUERY_STRING'];

$sql = "select *from posts where id_post='" . $id_post . "'";
$post_data = pg_query($sql);

/* #region New query - DATE/TIMESTAMP */
$sql_unique = "select *from posts where id_post='" . $id_post . "'";
$post_data_unique = pg_query($sql_unique);
$unique_post = pg_fetch_object($post_data_unique);

$new_date = $unique_post->created_at;
$date_edited = date('m-d-Y', $new_date);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        footer {
            bottom: 0;
            width: 100%;

            background-color: #f2f2f2;
            padding: 25px;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">TEST</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid bg-3 text-center">

        <?php while ($post = pg_fetch_object($post_data)) : ?>
            <h3></h3>
            <a href="javascript:window.history.back();" class="btn btn-primary pull-right" style='margin-top:-30px'>
                <span class="glyphicon glyphicon-step-backward"></span>Back
            </a>
            <a href="javascript:window.history.back();" class="py-2 px-4 bg-orange-400 font-semibold rounded text-white">
            </a>
            <br>

            <div class="panel panel-primary" style="border: none;">
                <div class="">-</div>
                <div class="form-horizontal">
                    <div class=" panel-body">

                        <h2><?= $post->title ?></h2>
                        <!-- <span class="text-sm"><?= $post->created_at ?></span> -->
                        <small> <?= $post->created_at ?> </small>
                        <img src="data:image/png;base64,<?= $post->post_picture ?>" alt="blog picture" style="width:90%;">
                        <h2><?= $post->content_post ?></h2>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        
</body>

<footer class="container-fluid text-center">
    <p>Eric Price ©
        <?= date('Y') ?>
    </p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/update.js"></script>
<script src="js/table.js"></script>


</body>

</html>