<link rel="stylesheet" type="text/css" href="css/sliding_nav.css" />
<script type="text/javascript" src="js/scripts.js"></script>
<script src="js/jquery-1.6.2.min.js"></script> 
<div id="header"><div class="wrap">
            <div id="slide-holder">
            <div id="slide-runner">
                <a href=""><img id="slide-img-1" src="images/environmental_banner.jpg" class="slide" alt="" /></a>
                <a href=""><img id="slide-img-2" src="images/gmp_banner.jpg" class="slide" alt="" /></a>
                <a href=""><img id="slide-img-3" src="images/quality_banner.jpg" class="slide" alt="" /></a>
                <a href=""><img id="slide-img-4" src="images/safety_banner.jpg" class="slide" alt="" /></a>
                <a href=""><img id="slide-img-5" src="images/security_banner.jpg" class="slide" alt="" /></a> 
				<a href=""><img id="slide-img-6" src="images/social_accoutnbaility_banner.jpg" class="slide" alt="" /></a> 
                <div id="slide-controls">
                 <!--<p id="slide-client" class="text"><strong>post: </strong><span></span></p>
                 <p id="slide-desc" class="text"></p>-->
                 <p id="slide-nav"></p>
                </div>
            </div>
                
                <!--content featured gallery here -->
               </div>
               <script type="text/javascript">
                if(!window.slider) var slider={};slider.data=[{"id":"slide-img-1","client":"","desc":""},{"id":"slide-img-2","client":"","desc":""},{"id":"slide-img-3","client":"nature beauty","desc":"add your description here"},{"id":"slide-img-4","client":"nature beauty","desc":"add your description here"},{"id":"slide-img-5","client":"nature beauty","desc":"add your description here"},{"id":"slide-img-6","client":"nature beauty","desc":"add your description here"}];
               </script>
              </div>
</div><!--/header-->	

<br/>
<div id="index">
		<div id="tabs">
			<?php
				if (!isset($tag))
				$tag="businesschallenge";
			//include_once("../../../".$tag.".html");
			include_once($tag.".html");
			?>
			
		</div>
		
	<div id="right">	
		<div id="overview"  >
		<b>Over<font class="white">view</font></b>
		<ul>
		<li><a href="?tag=benefits">Benefits</a></li>
		<li><a href="?tag=howitworks">How it works</a></li>
		<li><a href="?tag=partners">Partners</a></li>
		<li><a href="?tag=whycomplianceaudit">Why compliance audit?</a></li>
		</ul>
		</div>
		<div id="sustainability" >
		<b>Sustainability <font class="blue">Management</font></b>
		<ul>
		<li><a href="?tag=quality">Quality</a></li>
		<li><a href="?tag=environmental">Environmental</a></li>
		<li><a href="?tag=socialaccountability">Social Accountability</a></li>
		<li><a href="?tag=gmp">GMP (Good Manufacturing Practice)</a></li>
		<li><a href="?tag=occupationalhealthsafety">Occupational Health &amp; Safety</a></li>
		<li><a href="?tag=transportprotectionsecurity">Transport Protection Security</a></li>
		</ul>
		</div>
	</div>
</div><!-- End demo -->
