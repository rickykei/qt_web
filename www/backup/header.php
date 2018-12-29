<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/thickbox.js"></script>
<link rel="stylesheet" href="/css/thickbox.css" type="text/css" media="screen" />
</head>
<body>
<div id="container"  >

	<div id="header">
		<div class="logo"> 
			<a href=""><img src="/images/logo.jpg" alt="" /></a> 
		</div>
	</div>
	
	<div class="clear"></div>
	
    <div id="navigation">
    	<div id="menu">
            <ul id="MenuBar1">
              <li><a href="/?user=">MMain</a></li>
              <li><a href="/?user=buyer">Buyer</a></li>
              <li><a href="/?user=admin">Qualitech Admin</a></li>
			  <li><a href="/?user=auditor">Qualitech Auditor</a></li>
            </ul>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
	
	
	<?php
	if ($user=="") $user="buyer";
	include_once($user."_leftsidebar.php");?>
	 
	<div id="rightsidebar">
	<ul id="sidebar">
		<li>About us</li>
		<li>Our Service</li>
		<li>Contact us</li>
	</ul>
	</div>
	<div class="clear"></div>
	
	
	<?php
	if ($user!="" && $function!="")
		include_once($user."_".$function."_actionbar.php");
	?>
	
 
	<div class="clear"></div>
	<br>
	