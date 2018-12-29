<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

 	<script type="text/javascript">
		path = '<?=Yii::app()->request->baseUrl; ?>';
	</script>
	
	<? Yii::app()->clientScript->registerCoreScript('jquery');?>
	
	<style type="text/css">
	<!--
	.sectionheader {
		color: #FFF;
	}
	body,td,th {
		font-family: Verdana, Geneva, sans-serif;
	}
	
	input.error, select.error {
		background: #FEE;
		border-color: #C00;
	}
	
	.calendar_button {
		border: none;
		background: url(../css/calendar.gif) no-repeat center top;
		width:20px;
	}
	-->
	</style>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php echo $content; ?>

</body>
</html>