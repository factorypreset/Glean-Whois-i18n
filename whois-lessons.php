<?php
require_once 'includes/locales.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="google-site-verification" content="_OM4g6495NJ7Ut-rX2L-PT4uCvHNrBdCliP2gWJQmg8" />
	<meta name="description" content="WhoIs provides learners with a context in which to explore information about websites, including the ability to learn more about its creators and history.">
	<title>WhoIs Project: An Educational WhoIs Tool</title>

	<link href="stuff/style.css" rel="stylesheet" type="text/css" />
	<link href="stuff/standards.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="header_include/header_style.css" type="text/css" media="screen" />
    <!--[if IE]><script language="javascript" type="text/javascript" src="./flot/excanvas.min.js"></script><![endif]-->
  <?php include('sb_head_include.php'); ?>	
</head>

<body>

<!-- Inlude sitewide navigation -->
<div id="topl1">
  <div id="gsti"><a href="http://www.glean.org/" title="Glean" target="_new"><img src="header_include/images/gleansmalltop.png" alt="" width="110" height="26" /></a></div><div id="gsttext">Information Literacy Tools</div><div id="combotopbar"><a class="llt" href="http://www.plml.org/support-with-amazon-purchase" target="_new" >Support via Amazon Order</a><a class="llt loveit"   >Donate</a><a class="llt watchus"  href="#" >Join Mailing</a><a class="llt"  href="http://social.plml.org" target="_new" >Discuss</a><a class="llt"  href="http://projects.plml.org/public/index.php?path_info=submit" target="_new" >Report Bug</a></div>
  </div>
  <div id="topl2">
  	 <div style="position: relative; float:left; margin-left:10px;  ">
<!-- AddThis Button BEGIN -->
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pub=dhcrusoe3"><img src="http://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js?pub=dhcrusoe3"></script>
<!-- AddThis Button END -->
</div>	
<?php

include "includes/lang_selector.php";

?>
</div>
<?php

	$bIEsix = false;
	if( ( true == eregi( "msie 6", $_SERVER['HTTP_USER_AGENT'] ) ) || 
			( true == eregi( "msie 6.0", $_SERVER['HTTP_USER_AGENT'] ) ) || 
			( true == eregi( "msie 6.0b", $_SERVER['HTTP_USER_AGENT'] ) ) ||
			( !isset( $_SERVER['HTTP_USER_AGENT'] ) ) )
	{
		$bIEsix = true;
	} //if( true == $bIEsix )	echo "ãðüîáàíèé IE6";	else echo "ïàöàíñüêèé áðàóçåð";

//	if( true == $bIEsix ) // ie6
		echo "\n\t<div style=\"margin:auto; margin-top:0px; text-align:center; width:917px;\">\n";
	//else
		//echo "\n\t<div style=\"left:50%; top:0%; margin:0; margin-top:0px; margin-left:-458px; position:fixed; text-align:center; width:917px; border-width:0px; \">\n";
?>


<?php
//	if( true == $bIEsix ) // ie6
//		echo "\n\t<div style=\"margin:auto; margin-top:0px; text-align:center; width:845px; \">\n";
//	else
//		echo "\n\t<div style=\"left:50%; top:40px; margin:0; margin-top:0px; margin-left:-422px; position:fixed; text-align:center; width:845px; border-width:0px; \">\n";
?>
		<div id="header">

        <div id="ihead2">
      <h1 id="tags1">Who-Is</h1>
      <div id="menumainc">
      <ul>
					
					<li><a href="index.php" class="navnonactive"><?php echo _("Home"); ?></a></li>
					<li><a href="whois-lessons.php" class="navactive"><?php echo _("Lessons"); ?></a></li>
					<li><a href="http://www.glean.org" target="_blank" class="navnonactive"><?php echo _("Other Tools"); ?></a></li>
					<li><a href="help-whois.php" class="navnonactive"><?php echo _("Help"); ?></a></li>
					<li><a href="about-whois.php" class="navnonactive"><?php echo _("About"); ?></a></li>
					
				</ul>    
        </div>
		

		</div>
        </div>


<!-- don't forget to leave a </div> tag at the resulting page -->

<!-- End include -->

<Br><br>
<div id="main">

    <div id="BlueboxC">
    	<h3>Whois Curricula:</h3>
    	
<p>

<table width="100%" cellpadding="0" cellspacing="0"><tr>
<td width="10%"><img src="http://www.boolify.org/images/boolify_lesson.png"/>
</td>
<td>

<p>Why are Websites Created - [<a href="https://docs.google.com/document/pub?id=1gF7y7c9fNKXor8_sE88UKAlWQEnvwp9BjnJnAWFQQfM" target="_blank">Google Doc Online</a>] 

<p>Who's Behind the Website - [ <a href="https://docs.google.com/document/pub?id=1g2s0ItJSonmDFK61T6ErBGAzVCPTSDv-oTT24NQH0Z4" target="_blank">Google Doc Online </a>]
</td></tr></table>
    </div>


    <div id="BlueboxC">
    	<h3 style="margin: 0px;">Additional Resources:</h3>

<p>Read more about why websites are important to evaluate <a href="http://www.lesley.edu/library/guides/research/evaluating_web.html" target="_blank">online</a>, or learn the technical aspects of <a href="http://en.wikipedia.org/wiki/Whois" target="_blank">Whois</a> (warning: deep geekery). </p>
      
    </div>
    
        <div id="BlueboxC">
    	<h3 style="margin: 0px;">Discuss Lesson Ideas:</h3>

<p>Would you like to share your lesson ideas, or receive tips from others? Please check our the Public Learning Media <a href="http://social.plml.org/" target="_blank">Builders' Group</a> for more!</p> 

    </div>

        
    <div style="text-align: center; font-size: 10px;">Copyright (c) The Public Learning Media Laboratory, 2010. Read our <a href=http://www.boolify.org/privacy.php>privacy policy</a>. </div>
    
</div>
<?php  include('sb_body_include.php'); ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-3421032-13']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>