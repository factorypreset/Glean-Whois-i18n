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
	} //if( true == $bIEsix )	echo "грьобаний IE6";	else echo "пацанський браузер";

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
					
					<li><a href="index.php" class="navactive"><?php echo _("Home"); ?></a></li>
					<li><a href="whois-lessons.php" class="navnonactive"><?php echo _("Lessons"); ?></a></li>
					<li><a href="http://www.glean.org" target="_blank" class="navnonactive"><?php echo _("Other Tools"); ?></a></li>
					<li><a href="help-whois.php" class="navnonactive"><?php echo _("Help"); ?></a></li>
					<li><a href="about-whois.php" class="navnonactive"><?php echo _("About"); ?></a></li>
					
				</ul>    
        </div>
		

		</div>
        </div>
        <p style="display: block; width: 800px; text-align: left; margin-left: auto; margin-right: auto; background:#fff7e2; padding: 6px; color: black; ">
		<?php echo _("Glean Whois provides a framework for looking at information about who has registered and owns a domain name on the Web."); ?></p>
		


<!-- don't forget to leave a </div> tag at the resulting page -->
