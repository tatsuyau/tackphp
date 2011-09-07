<!DOCTYPE html>
<html>
<head>
<title><?php echo SITE_TITLE; ?> | <?php echo $this->controllerName; ?>::<?php echo $this->actionName; ?></title>
<link rel='stylesheet' href='/css/style.css' />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> 
<script type="text/javascript" src="./js/client.js"></script> 
</head>
<body>
<div id="wrapper">
<header>
<h1><?php echo SITE_TITLE; ?></h1>
</header>

<article>
<?php require_once $this->contents_for_layout; ?>
</article>


<footer>
<?php echo SITE_TITLE; ?>
</footer>
</div><!-- #wrapper -->
