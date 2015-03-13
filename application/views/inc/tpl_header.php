<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('static/css/typo.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('static/css/style.css')?>">
<?if($this->uri->segment(1)!='index' && $this->uri->segment(2)!='index'):?>
	<link rel="stylesheet" type="text/css" href="<?=base_url('static/sco/css/sco.message.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('static/icomoon/style.css')?>">
	<script type="text/javascript" src="<?=base_url('static/js/jquery-1.11.1.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('static/sco/js/sco.message.js')?>"></script>
<?endif;?>
</head>
<body>
