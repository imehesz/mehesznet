<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stored.by.u</title>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/table.css" />

<?php echo CGoogleApi::init(); ?>

<?php echo CHtml::script(
    CGoogleApi::load('jquery','1.3.2') . "\n"
); ?>


</head>

<body>

	<div id="container">
        <?= $content; ?>
		<div id="bottom">
            <span>&copy; 2003 - <?= date( 'Y', time() ); ?>  mehesz<font style="color:#f00;">.</font>net</span> Home - <a href="#">About</a> - <a href="#">Contact</a> - <a href="#">Advertise</a>
		</div>

        <?php /*
		<div id="keywords">
            Here are some text about the operation snd such ... blah blah blah enad etc etc etc
        </div>
         */ ?>
	</div>
</body>
</html>
