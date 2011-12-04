<?php
require_once 'includes/locales.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="google-site-verification" content="_OM4g6495NJ7Ut-rX2L-PT4uCvHNrBdCliP2gWJQmg8" />
	<meta name="description" content="WhoIs Project: A Tool to Investigate Information Authority, Authenticity, Ownership and Perspective.">
	<title>WhoIs Project: A Tool to Investigate Information Authority, Authenticity, Ownership and Perspective</title>

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
					<li><a href="whois-lessons.php" class="navnonactive"><?php echo _("Lessons"); ?></a></li>
					<li><a href="http://www.glean.org" target="_blank" class="navnonactive"><?php echo _("Other Tools"); ?></a></li>
					<li><a href="help-whois.php" class="navnonactive"><?php echo _("Help"); ?></a></li>
					<li><a href="about-whois.php" class="navactive"><?php echo _("About"); ?></a></li>
					
				</ul>    
        </div>
		

		</div>
        </div>


<!-- don't forget to leave a </div> tag at the resulting page -->

<!-- End include -->

<Br><br>
<div id="main">


    <div id="BlueboxC">
    	<h3>Why Use GleanWhoIS:</h3>

<p>Authority. Authenticity. Ownership. Perspective. These four pillars make up the critical facets of the information we consume -- and understanding them makes us and our students wiser users of information. <p>

<p>However, on the web, people often make assumptions about the authority and authenticity of information, and it can be challenging to understand ownership and perspective. The Glean Who-Is Tool help you and your students learn to investigate web-based content sources. By using technical information about websites (“whois”), along with historical and factual information, the tool encourages us to dig more deeply, to understand more thoroughly, and to critique more closely.</p>

    </div>
    
      <div id="BlueboxC">
    	<h3 style="margin: 0px;">About the creators:</h3>

<p><a href="http://www.plml.org" target="_blank">Public Learning Media, Inc</a> is a 501(c)(3) nonprofit that creates web-based applications for teaching complex concepts to elementary and middle school students, and shares these applications freely with the education community.</p>

<p>By drawing on proven research, great teaching, and innovative thinking, we create tools that help teachers use the modeling and interactivity that is inherent in digital applications to bring deeper and clearer understanding to their students. We focus on tools that support information literacy, including math concepts, science knowledge, and how to think and work with data.</p>

<p>Each <a href="http://www.glean.org" target="_blank">Glean</a> technology is the result of collaborative effort by <a href="http://www.plml.org" target="_blank">Public Learning Media, Inc</a> along with expert educators, designers and coders. </p>
   
<p>Please send questions (or report bugs) to us through our <a href="http://www.plml.org/contact" target="_blank">online contact form.</a></p>  
    </div>

    
    
    <div style="text-align: center; font-size: 10px;">Copyright (c) The Public Learning Media Laboratory, 2010. Read our <a href="http://www.plml.org/privacy-policy" target="_blank">privacy policy</a>. </div>
    
</div>
<?php  include('sb_body_include.php'); ?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-3421032-6");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>