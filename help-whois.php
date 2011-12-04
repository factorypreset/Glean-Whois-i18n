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
					<li><a href="help-whois.php" class="navactive"><?php echo _("Help"); ?></a></li>
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
    	<h3>Using Glean Who-Is</h3>

<p>When the page loads, you'll be walked through as series of steps that serve as a framework for asking question about the domain.</p>
<p>In Step 1, enter the URL of the website domain about whose ownership you want more information and press ENTER.  Now you’ll see a whole series of steps. You can do as many or as few of the steps as you want.</p>
<p>In each step. Glean Who-Is displays information panes that you can open or close. Each pane tells you something specific about the domain. </p>
<p>Use the text box on the right site of the page as a handy place to take notes or cut and paste information. In Step 7: Print or Save you can print or save your notes for later use.</p>
    </div>
 
 <div id="BlueboxC">
    	<h3>Panel Details</h3>
 
<p><b>What kind of site is it?</b><br/>
This panel points out the domain’s extension. The extension is the letters after the "." in the URL. Common domains include .org (usually, but not always, a nonprofit organization), .com (commercial), .net (network) and .edu (post secondary education). This information provides a general guide to understanding what kind of organization might own the domain you are researching.
</p>

<p><b>What can you learn from its ownership?</b><br/>
From this panel you can run and display the WhoIs search, by clicking on the red "WhoIs" link.  The WhoIs report appears in a box on the left side of the screen. If you highlight any portion of the report, you'll see search results about the highlighted text on the right hand side of the screen.  Both the WhoIs report and your subsequent searches can help you understand more about who owns the domain.
</p>

<p><b>What can you learn from its history?</b><br/>
This panel runs the Internet Archive's Way Back Machine, which lets you see past versions of the site. This historical information can some times provide valuable insight into the thinking of the site’s owners. Please note, however, that Way Back doesn’t archive every single site and we can only present information that Way Back stores in its databases.
</p>

<p><b>Reference Materials</b><br/>
This panel searches Wikipedia for references to the domain. Although Wikipedia does not have centralized editing and fact checking oversight and portions of it may be authored by anonymous contributors, it none-the-less often has useful background information and can be a useful reference. <i>Please note, however, good practice suggests exploring Wikipedia information critically, rather than accepting it at face value.</i></p>

<p><b>Who else links to it?</b><br/>
This panel displays a search of sites that link back to the domain you are researching. Seeing who is linking to this site can sometimes provide helpful information about how this site is perceived. For example, peer-reviewed and professional websites typically link to other reviewed and honest websites. Sites that perpetuate SPAM typically link to other spam sites.
</p>

<p><b>Save and Print</b><br/>
This panel lets you print or save the WhoIs report and your notes.
</p>
<!-- <p><b>1. Clearly define what you want to know.</b></p>

<p>If you are conducting a research project for school, you will want to determine a website's authority on the subject matter and ensure that it is a valid and credible source of information. As you generate a list of sources, ask yourself: is an individual, a small group of people, or an organization behind this website? What can I tell about who own's the site at a first glance? What is their motivation or agenda behind hosting this website?</p>

<p>Example: Look up the following websites on Martin Luther King. Then, enter their URLS in GleanWhoIs and notice the differences in website ownership. Does who owns the website help explain some of the differences in the views expressed on these websites?</p>

<ul>
  	<li>Website: <a target="_blank" href="http://www.martinlutherking.org">http://www.martinlutherking.org</a> and GleanWhoIs <a target="_blank" href="http://www.gleanwhois.org?url=www.martinlutherking.org">information</a></li>
  	<li>Website: <a target="_blank" href="http://www.u-s-history.com/pages/h154.html">http://www.u-s-history.com</a> and GleanWhoIs <a target="_blank" href="http://www.gleanwhois.org?url=www.u-s-history.com">information</a></li>
  </ul>

<p>Example: Look up the following websites/blogs and enter their URLS in GleanWhoIs. Can you tell if individuals or an organization owns these sites? What might their agendas be?</p>   

<ul>
  	<li>Website: <a target="_blank" href="http://www.gleanwhois.org">http://www.gleanwhois.org</a> and GleanWhoIs: <a target="_blank" href="http://www.gleanwhois.org?url=www.gleanwhois.org">information</a></li>
  	<li>Website: <a target="_blank" href="http://educationtechnologyblog.com/">http://educationtechnologyblog.com/</a> and GleanWhoIs <a href="http://www.gleanwhois.org?url=http://educationtechnologyblog.com/" target="_blank">information</a>.</li>
  </ul>


<p><b>2. Start with a GleanWhoIs search.</b></p>

<p>Enter the URL into the search bar of the GleanWhoIs tool. Scan the results and while some of what you read may be useful, much may not make much sense at first. Here are two common next steps that you can take with the information available in the results:</p>

<ul>
	<li><p>If information about the website's administrative, corporate or technical contacts is available, look at this closely. If an organization is listed, do a quick Google or Wikipedia search for that organization and see what you can find out about the organization. If an individual is listed, see if you can find any of their affiliations through a Google search. If information about where the website's owners are based, take note of that information as well. It could be informative of the website creators' agenda or motivation. </p></li>
	<li><p>About 20% of the time (<a href="http://securityskeptic.typepad.com/APWGeCrime2010-PiscitelloShengv3.pdf" target="_blank">source</a>), you are likely to run across garbled or incorrect-looking information. This, too, is valuable because it tells you that the owners of the website have chosen to remain anonymous or private. What are some reasons they might want to hide their information?</p></li>
</ul>

<p><b>3. Try the "View Website Info on Wikipedia" link (located above your GleanWhoIs results). </b></p>

<p>Depending on your website, there are two possible kinds of results that the Wikipedia link may provide:</p>

<ul>
	<li><p>You see a series of articles or links to articles that describe your site or organization. This is definitely helpful as it provides a good source of additional links and information. </p></li>
	<li><p>You do not see any articles "with that exact name" from this initial search. Don't give up! There is still hope!</p></li>
</ul>

<p>Wilstar.com is a site that ranks highly for searches about <a target="_blank" href="http://www.google.com/search?hl=en&source=hp&biw=1436&bih=768&q=george+washington+thanksgiving&aq=f&aqi=g9&aql=&oq=&gs_rfai=">George Washington</a> but it doesn't present any results in <a href="http://en.wikipedia.org/wiki/Wilstar" target="_blank">Wikipedia</a>. However, if you click on "search for the name in existing articles" you are likely to find several results that pertain to your search. Here is an example the pages on Wikipedia that refer to <a href="http://en.wikipedia.org/wiki/Special:Search/Wilstar" target="_blank">Wilstar.com</a></p>.

<p>What do you think the author of this site has done to be listed in so many places? Why do you think he/she has done that?</p>

<p><b>4. Check out the "View Website History on the WayBackMachine" link (also located above your GleanWhoIs results).</b></p>

<p>Through this link, you can explore the website's history. Note when and how the website has undergone significant changes, especially with respect to content changes. What was happening around that time in the news?</p>

<p><b>5. Be creative in your researching!</b></p>
<p>Often you can stumble across a minefield of relevant, but less easily discoverable, information if you are inventive with your web searching.</p>
<p>For example, while researching a topic about <a href="http://www.google.com/search?hl=en&source=hp&biw=1436&bih=768&q=%22george+washington%22+thanksgiving&aq=f&aqi=g9&aql=&oq=&gs_rfai=" target="_blank">George Washington and Thanksgiving</a>, we found many top-ranked sites feature a <a href="http://wilstar.com/holidays/wash_thanks.html" target="_blank">writeup of his Thanksgiving Speech</a>. In the references, we found that it was transcribed by someone named "Maurice Smith". It turns out that <a href="http://www.google.com/search?hl=en&safe=off&biw=1436&bih=768&q=%22This+page+courtesy+of+Maurice+Smith%22&aq=f&aqi=&aql=&oq=&gs_rfai=" target="_blank">several sites</a>  have all copied the text from a common source but the text has since been edited slightly from the <a href="http://lcweb2.loc.gov/ammem/GW/gw004.html" target="_blank">original</a> speech. Can you find the changes? If so, please <a href="http://www.plml.org/contact" target="_blank">write us</a> - the first person to do so with receive a Boolify mug!</p>

-->

    </div>
<!--    
    <div id="BlueboxC">
    	<h3>Frequently Asked Questions:</h3>

<p><b>I have questions about the tool, about using in a class, or anything else. Who can I contact?</b></p>

<p>Please contact The Public Learning Media Laboratory staff through our <a href="http://www.plml.org/contact" target="_blank">online form, or by phone</a> at any time.</p>

<p><b>Why doesn't my domain search turn up information?</b></p>

<p>Some domain owners set their registration information to be private. The reasons vary, but typically it is to hide the owner, address or e-mail information associated with accounts.</p>

<p><b>What assurance do I have that the information is accurate?</b></p>

<p>Actually, we have little complete assurance that the information retrieved through Whois technical services is the true identity of the owner. While this information is usually accurate, some entities purposefully enter misleading information. For instance, in the 2010 mid-term election, we found that political action groups (on all sides of the aisle) entered vague information about their true identities.</p>    

<p><b>What is the difference between an Administrative Contact and a Technical Contact?</b></p>

<p>In some cases, the Administrative and Technical Contact will provide different information. While no standard or requirement exists to enter different information, differences in these fields may point out that the Administrative office of an organization are separate from the Technical offices.</p>    
  
</td></tr></table>

    </div>
-->    
    
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