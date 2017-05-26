<?php
require 'request_login.php';
$opts = array(
  'id_entry' => 'duSWnS1sW', //differentiate multiple entries, use random string (required)
  'title' => 'Login', // Title shown in page, default is 'Login'
  'usr_pwd' => array('user'=>'pw'), // user name and password pairs (at least one required)
  'duration' => 5,// how long (hours) to make it valid (default: 72 )
  'background_img'=> 'cover.jpg',//background image (default: NULL)
);
      (new request_login())->load($opts);
?>
<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>Welcome App - Administration</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.3/foundation.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.3/foundation.min.css" media="screen" title="no title">
    <link rel="stylesheet" href="http://welcome.iten.pt/admin/css/style.css?1474282660" media="screen" title="no title">
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script>
    webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
</script>
  </head>
  <body>
  <?php
    require_once('dbcon.php');
    require_once('functions.php');
  ?>
