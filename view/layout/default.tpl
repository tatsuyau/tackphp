<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title><?php echo SITE_TITLE; ?></title>
<meta name="description" content="">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo WEBROOT; ?>/js/client.js"></script> 
<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo WEBROOT; ?>/css/style.css">

</head>
<body>

<?php require_once '../view/layout/header.tpl'; ?>

<header>
	<div class="inner">
		<div class="container">
			<h1><?php echo SITE_TITLE; ?></h1>
		</div>
	</div>
</header>


<article>
<div class="container">
	<?php require_once $this->contents_for_layout; ?>
</div>
</article>

<footer>
	<div class="container">
	<p>tackphp was developed by tatsuya uehara.<br />
	<a href="http://tackphp.jp/">tackphp official site</a>
	</div>
</footer>
</body>
</html>
