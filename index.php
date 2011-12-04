<?php
require_once 'includes/locales.php';

// [2010.Dec.09] Add the ability to consume domains from the URL for immediate display, e.g., http://www.gleanwhois.org/?url=www.google.com.
$passedURL = "";
if( isset( $_GET['url'] ) )
{
	$passedURL = $_GET['url'];
}

if( isset($_GET['currentLang']) && strlen($_GET['currentLang']) == 2)
{
	$langArray = array( 'en'=>0, 'es'=>1, 'sv'=>2, 'pt'=>3 );
	$startingLanguage = $langArray[$_GET['currentLang']];
}
else
{
	$startingLanguage = 0;
}
if($startingLanguage == 0)
{
	require_once 'lang_param/en_us.php';
}
elseif($startingLanguage == 1)
{
	require_once 'lang_param/es_es.php';
}
else
{
	require_once 'lang_param/en_us.php';
}





function outputLanguage( $xml, $tag, $span )
{
	global $startingLanguage;
	$return = '';
	if($span)
	{
		$return .= '<span class="translate" id="';
	}
	$numLangs = count($xml->language);
	for( $n=0; $n<$numLangs; $n++ )
	{
		$return .= $xml->language[$n]->$tag;
		if($n<$numLangs-1)
		{
			$return .= '|';
		}
	}
	if($span)
	{
		$return .= '">'.$xml->language[$startingLanguage]->$tag.'</span>';
	}
	return $return;
}

if( !file_exists('stuff/language.xml') )
{
	die('Could not find language file.');
}
else
{
	$xml = new SimpleXMLElement( 'stuff/language.xml', NULL, TRUE );
	$xml->asXML();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="google-site-verification" content="_OM4g6495NJ7Ut-rX2L-PT4uCvHNrBdCliP2gWJQmg8" />
	<meta name="description" content="WhoIs Project: A Tool to Investigate Information Authority, Authenticity, Ownership and Perspective."/>
	<title>WhoIs Project: A Tool to Investigate Information Authority, Authenticity, Ownership and Perspective</title>

	<link href="stuff/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
#printertitlemain
{
	width:100%;
	height:auto;
	font-size:24px;
	font-weight:bold;
	margin-top:5px;
	margin-bottom:5px;
	font-family:Arial, Helvetica, sans-serif;
}
#printertitlesite
{
		width:100%;
	height:auto;
	font-size:16px;
	font-weight:bold;
	margin-top:5px;
	margin-bottom:5px;
		font-family:Arial, Helvetica, sans-serif;
}
#printertitlefindings
{
			width:100%;
	height:auto;
	font-size:16px;
	font-weight:bold;
	margin-top:5px;
	margin-bottom:5px;
		font-family:Arial, Helvetica, sans-serif;
}
#printertitlewhoisdata
{
			width:100%;
	height:auto;
	font-size:16px;
	font-weight:bold;
	margin-top:5px;
	margin-bottom:5px;
		font-family:Arial, Helvetica, sans-serif;
}

#printercontentsite
{
			width:100%;
	height:auto;
	font-size:14px;
	margin-top:5px;
	margin-bottom:5px;
		font-family:Arial, Helvetica, sans-serif;
}
#printercontentfindings
{
			width:100%;
	height:auto;
	font-size:14px;
	margin-top:5px;
	margin-bottom:5px;
	font-weight:bold;
		font-family:Arial, Helvetica, sans-serif;
}
#printercontentwhoisdata
{
			width:100%;
	height:auto;
	font-size:14px;
	margin-top:5px;
	margin-bottom:5px;
		font-family:Arial, Helvetica, sans-serif;
}
 
</style>

<?php
// dimic: ! IE6 detetion from JS ! !

//<!--[if IE 6]>
//<script type="text/javascript"> 
//	window.location = "http://www.boolify.org/boolify_ie6/index.php"; 
//</script>
//<![endif]-->
?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<script src="http://www.google.com/jsapi?key=ABQIAAAA4JIh6t6WqZ6bu2qtSfaUHRT_MH5dYcXsMMhjPNkaLjfPMzh-axSMnb84GYT7DC4z1i5TuBUrsL4K-g" type="text/javascript"></script>
<script type="text/javascript" src="stuff/jquery-1.4.3.min.js"></script>

<script type="text/javascript">

var currentLang = <?php echo $startingLanguage; ?>;

var googleQuery = "";
var additionalBlocksShow = 1;

	function doWhoisAjax( domain )
	{
		var xmlData = "";
		var xmlWhole = "";
		var xmlGlitch = "";
		var xmlError = "";
		var xmlHistory = "";
		var xmlWiki = "";
		var xmlDomain = "";

		// send request, show loader and accept response
		resetWhoisContent();
		resetGoogleContent();

		$("#whois").fadeIn(300);
		$('#goog').fadeIn(300);
		$("#whois_loader").fadeIn(300);
//		$("#whois_loader").fadeIn(300);
if(document.getElementById("hugecontainer").style.display!="none")
{
 $("#hugecontainer").animate({
    opacity: 0.25,
    height: 'toggle'
  }, 300, function() {
    // Animation complete.
  });
}

		$.ajax({
			type: "GET",
			url: "stuff/api.php",
			data: "domain=" + domain,
			dataType: "xml",

			success: function(xml) // response function
			{
				
				$("#whois_loader").hide();

				$(xml).find('content').each(function(){
					xmlData = $(this).find('data').text();
					xmlWhole = $(this).find('whole').text();
					xmlGlitch = $(this).find('glitch').text();
					xmlError = $(this).find('error').text();
					xmlDomain = $(this).find('domain').text();
//alert(xmlError);

					$(xml).find('links').each(function(){
						xmlHistory = $(this).find('history').text();
						xmlWiki = $(this).find('wiki').text();
					});


					// build 
				//	var buoy = '<div id="whois_help0"><div id="whois_help" onclick="showModalHelp();"><img id="whois_help_img" src="images/btn_help.png" alt="help" /><p id="whois_help_txt">Help! Please explain what I see here.</p></div></div>';
					var showAll = '<div id="whois_data_showall" onclick="flipBlocks();">@</div>';

					document.getElementById('whois_data').innerHTML =  decodeText( xmlData ) + showAll;
					document.getElementById('whois_whole').innerHTML = decodeText( xmlWhole );
					document.getElementById('whois_glitch').innerHTML = decodeText( xmlGlitch );
					document.getElementById('whois_error').innerHTML = decodeText( xmlError );
					document.getElementById('whois_error2').innerHTML = decodeText( xmlError );


					if( "" != xmlData )
					{
						 $("#hugecontainer").animate({
    opacity: 1,
    height: 'toggle'
  }, 1000, function() {
    // Animation complete.
  });
  
  var dot = domain.lastIndexOf(".");
var dname = domain.substring(0,dot);
var extensiond = domain.substring(dot,domain.length);
extensiond=extensiond.replace(/^\s+|\s+$/g, '') ;
//alert(extensiond);
if(extensiond==".com")
{
	goodtext=textfor_com;
}
else if(extensiond==".net")
{
	goodtext=textfor_net;
}
else if(extensiond==".org")
{
	goodtext=textfor_org;
}
else if(extensiond==".edu")
{
	goodtext=textfor_edu;
}
else if(extensiond==".gov")
{
	goodtext=textfor_gov;
}
else if(extensiond==".info")
{
	goodtext=textfor_info;
}
else if(extensiond==".us")
{
	goodtext=textfor_us;
}
else 
{
	goodtext=textfor_other;
}
  document.getElementById("s2corg").innerHTML=extensiond;
  document.getElementById("s2ctext").innerHTML=goodtext;
//let's make links
//step3lnktext
var helpert6='http://www.bing.com/search?q=inbody%3A'+domain+'&go=&qs=n&sk=&sc=2-13&form=QBLH&filt=all';
		var l3full = "<a class='cleanlink' href='javascript:jumpmodal();' >" + step3lnktext + "</a>";
		var l4full = "<a class='cleanlink' href='" + xmlHistory + "' target='_blank'>" + step4lnktext + "</a>";
		//
		//
		var l5full = "<a class='cleanlink' href='" + xmlWiki + "' target='_blank'>" + step5lnktext + "</a>";
		var l6full = "<a class='cleanlink' href='" + helpert6 + "' target='_blank'>" + step6lnktext + "</a>";
		document.getElementById("s3link").innerHTML=l3full;
		document.getElementById("s4link").innerHTML=l4full;
		document.getElementById("s5link").innerHTML=l5full;
		document.getElementById("s6link").innerHTML=l6full;
						
						$("#whois_data").fadeIn(300);
						//$("#links").fadeIn(300);
						//document.getElementById('links').innerHTML = "&nbsp;";
					}
					else
					{
						$("#whois_error").fadeIn(300);
						$("#whois_error2").fadeIn(300);
					}

//					document.getElementById('whois_data').innerHTML = xmlWhole;
				});



			},
			error: function(e){
				alert('Error: ' + e);
			}
		});
	}

	function flipBlocks() // show / hide additional blocks
	{
		if( 1 == additionalBlocksShow )
		{
			$("#whois_whole").fadeIn(200);
			$("#whois_error").fadeIn(200);
			$("#whois_glitch").fadeIn(200);
		}
		else
		{
			$("#whois_whole").hide();//fadeOut(300);
			$("#whois_error").hide();//fadeOut(300);
			$("#whois_error2").hide();//fadeOut(300);
			$("#whois_glitch").hide();//fadeOut(300);
		}

		additionalBlocksShow = 1 - additionalBlocksShow;
	}

	//---------------------
	// wipe all content and hide all blocks
	function resetWhoisContent()
	{
		// wipe content
		document.getElementById('whois_data').innerHTML = "";
  	document.getElementById('whois_whole').innerHTML = "";
  	document.getElementById('whois_glitch').innerHTML = "";
  	document.getElementById('whois_error').innerHTML = "";
  //	document.getElementById('links').innerHTML = "";

		// hide them
		$("#whois").hide();
		$("#whois_data").hide();
		$("#whois_whole").hide();
		$("#whois_glitch").hide();
		$("#whois_error").hide();
		$("#whois_error2").hide();
		$("#whois_loader").hide();
		//$("#links").hide();
	}

	function clearAll()
	{
//		document.getElementById('whois_data').innerHTML = "";
  //	document.getElementById('links').innerHTML = "";

		//$("#results").hide();
		//$("#whois_data").hide();

//		$("#results").fadeOut(300);
	//	$("#whois_loader").fadeOut(300);

//resetGoogleContent();
		$("#hugecontainer").fadeOut(200);
		//$("#links").fadeOut(200);
		document.getElementById("typedURL").value="";
		reset_stages(0);
		
	}
	function reset_stages(theexclude)
	{
	//	return false;
				 var j;
	   for(j=2;j<8;j++)
	   {
		   var fakeidee="sc"+j;
		   var fakeideef="#sc"+j;
		  // alert(fakeidee)
		   	   if(document.getElementById(fakeidee).style.display!="none" && theexclude!=j)
	   {
		  // alert("one down");
	
$(fakeideef).animate({
 opacity: 0.25,
    left: '+=455',
    height: 'toggle'
  }, 600, function() {
    // Animation complete.
  });
  
  
	  var formert3="niceminbut"+j;
  document.getElementById(formert3).src="images/minbutt.png";
  break;
	   }//if
	   else
	   {
		   continue;
	   }
	   }//for
	}

	function decodeText( txt )
	{
// http://www.w3schools.com/jsref/jsref_obj_regexp.asp
		txt = txt.replace( /\[/g, "<" );
		txt = txt.replace( /\]/g, ">" );

		return txt;
	}

	function translate(words)
	{
		var langArr = words.split("|");
		var output = langArr[currentLang];
		return output;
	}



	/* Google API stuff */

	google.load("search", "1", {"language" : "en"});

	function doGoogle( searchStr )
	{
//alert( searchStr );
		resetGoogleContent();
		//document.getElementById('goog_header').innerHTML = "";
Search(searchStr);
	}

	//---------------------
	// wipe all content and hide all blocks
	function resetGoogleContent()
	{
		// wipe content
		document.getElementById('goog_header').innerHTML = "Your Search Results";
		document.getElementById('goog_data').innerHTML = "";


		// hide them
	//	$("#goog").hide();
	//	$("#goog_data").hide();
		//$("#branding").hide();
	}

	/////////////////////
	function onLoadProcess()
	{
		//
		var passedUrl = <? echo '"'.$passedURL.'"'; ?>;

		//if( passserUrl.replace(/\s/g,"") == ""){

		if( "" != passedUrl )
		{
			document.getElementById('typedURL').value = passedUrl;
			autoSearchFor( passedUrl );
		}
//		else
	//	{
			document.getElementById('typedURL').focus();
		//}
	}

	function autoSearchFor( domain )
	{
		//
		doWhoisAjax( domain );
	}

</script>


 <script type="text/javascript">
	var totalres=0;
	var curentlastspos= 0;
	var openprogress=0;
	function compose_paginate(totalres)
	{
		//alert('paginate required fro '+totalres);
		totalres=parseInt(totalres);
		var listret="";
	 if(totalres<=5 && totalres>0)
		{
			listret='<div class="paginate-cursor-page paginate-cursor-current-page"><a id="plk1" class="paglinks" href="javascript:switch_respage(1);">1</a></div><div class="paginate-cursor-page"><a class="paglinks" href="javascript:switch_respage(2);">2</a></div>';
		}
								else if(totalres<=10 && totalres>5)
		{
			listret='<div class="paginate-cursor-page paginate-cursor-current-page"><a id="plk1" class="paglinks" href="javascript:switch_respage(1);">1</a></div><div class="paginate-cursor-page"><a id="plk2" class="paglinks" href="javascript:switch_respage(2);">2</a></div>';
		}
							else if(totalres<=15 && totalres>10)
		{
			listret='<div class="paginate-cursor-page paginate-cursor-current-page"><a id="plk1" class="paglinks" href="javascript:switch_respage(1);">1</a></div><div class="paginate-cursor-page"><a id="plk2" class="paglinks" href="javascript:switch_respage(2);">2</a></div><div class="paginate-cursor-page"><a id="plk3" class="paglinks" href="javascript:switch_respage(3);">3</a></div>';
		}
						else if(totalres<=20 && totalres>15)
		{
			listret='<div class="paginate-cursor-page paginate-cursor-current-page"><a id="plk1" class="paglinks" href="javascript:switch_respage(1);">1</a></div><div class="paginate-cursor-page"><a id="plk2" class="paglinks" href="javascript:switch_respage(2);">2</a></div><div class="paginate-cursor-page"><a id="plk3" class="paglinks" href="javascript:switch_respage(3);">3</a></div><div class="paginate-cursor-page"><a id="plk4" class="paglinks" href="javascript:switch_respage(4);">4</a></div>';
		}
					else if(totalres<=25 && totalres>20)
		{
			listret='<div class="paginate-cursor-page paginate-cursor-current-page"><a id="plk1" class="paglinks" href="javascript:switch_respage(1);">1</a></div><div class="paginate-cursor-page"><a id="plk2" class="paglinks" href="javascript:switch_respage(2);">2</a></div><div class="paginate-cursor-page"><a id="plk3" class="paglinks" href="javascript:switch_respage(3);">3</a></div><div class="paginate-cursor-page"><a id="plk4" class="paglinks" href="javascript:switch_respage(4);">4</a></div><div class="paginate-cursor-page"><a id="plk5" class="paglinks" href="javascript:switch_respage(5);">5</a></div>';
		}
				else if(totalres<=30 && totalres>25)
		{
			listret='<div class="paginate-cursor-page paginate-cursor-current-page"><a id="plk1" class="paglinks" href="javascript:switch_respage(1);">1</a></div><div class="paginate-cursor-page"><a id="plk2" class="paglinks" href="javascript:switch_respage(2);">2</a></div><div class="paginate-cursor-page"><a id="plk3" class="paglinks" href="javascript:switch_respage(3);">3</a></div><div class="paginate-cursor-page"><a id="plk4" class="paglinks" href="javascript:switch_respage(4);">4</a></div><div class="paginate-cursor-page"><a id="plk5" class="paglinks" href="javascript:switch_respage(5);">5</a></div><div class="paginate-cursor-page"><a id="plk6" class="paglinks" href="javascript:switch_respage(6);">6</a></div>';
		}
			else if(totalres<=35 && totalres>30)
		{
			listret='<div class="paginate-cursor-page paginate-cursor-current-page"><a id="plk1" class="paglinks" href="javascript:switch_respage(1);">1</a></div><div class="paginate-cursor-page"><a id="plk2" class="paglinks" href="javascript:switch_respage(2);">2</a></div><div class="paginate-cursor-page"><a id="plk3" class="paglinks" href="javascript:switch_respage(3);">3</a></div><div class="paginate-cursor-page"><a id="plk4" class="paglinks" href="javascript:switch_respage(4);">4</a></div><div class="paginate-cursor-page"><a id="plk5" class="paglinks" href="javascript:switch_respage(5);">5</a></div><div class="paginate-cursor-page"><a id="plk6" class="paglinks" href="javascript:switch_respage(6);">6</a></div><div class="paginate-cursor-page"><a id="plk7" class="paglinks" href="javascript:switch_respage(7);">7</a></div>';
		}
		else if(totalres>35)
		{
			listret='<div class="paginate-cursor-page paginate-cursor-current-page"><a id="plk1" class="paglinks" href="javascript:switch_respage(1);">1</a></div><div class="paginate-cursor-page"><a id="plk2" class="paglinks" href="javascript:switch_respage(2);">2</a></div><div class="paginate-cursor-page"><a id="plk3" class="paglinks" href="javascript:switch_respage(3);">3</a></div><div class="paginate-cursor-page"><a id="plk4" class="paglinks" href="javascript:switch_respage(4);">4</a></div><div class="paginate-cursor-page"><a id="plk5" class="paglinks" href="javascript:switch_respage(5);">5</a></div><div class="paginate-cursor-page"><a id="plk6" class="paglinks" href="javascript:switch_respage(6);">6</a></div><div class="paginate-cursor-page"><a id="plk7" class="paglinks" href="javascript:switch_respage(7);">7</a></div><div class="paginate-cursor-page"><a id="plk8" class="paglinks" href="javascript:switch_respage(8);">8</a></div>';
		}
		return listret;
	}

    
    // Replace the following string with the AppId you received from the
    // Bing Developer Center.
    var AppId = "AAF4046760662B8A8FDCDEFABD57F8389629D175";
    var searchControl="goog_data";
	var cicihead="goog_header";
    // Bing API 2.0 code sample demonstrating the use of the
    // Web SourceType over the JSON Protocol.
	var lastcallr='l';
	var curentlastspos=0;
	var lsavestr="";
	var rsavestr="";
    function Search(searchstr)
	    {
			openprogress++;
			if(openprogress>1){
			var ttim=setTimeout(function(){Search(searchstr,searchControl2)},500);
			 return false;}
			//alert(searchstr+"="+searchControl2);
		//Search(lsavestr,"leftResultsHeader")

				searchControl="goog_data";
				cicihead="goog_header";
				//lastcallr='l';
		lsavestr=searchstr;
			//	alert('left update');


		//alert(safeSearch);
    //    alert("serch called for "+searchstr);
        var requestStr = "http://api.bing.net/json.aspx?"
        
            // Common request fields (required)
            + "AppId=" + AppId
            + "&Query="+searchstr
            + "&Sources=web"
            
            // Common request fields (optional)
            + "&Version=2.0"
            + "&Market=en-us"
            + "&Adult=strict"
            + "&Options=EnableHighlighting"

            // Web-specific request fields (optional)
            + "&Web.Count=5"
            + "&Web.Offset="+curentlastspos
            + "&Web.Options=DisableHostCollapsing+DisableQueryAlterations"

            // JSON-specific request fields (optional)
            + "&JsonType=callback"
            + "&JsonCallback=SearchCompleted";

        // var requestScript = document.getElementById("searchCallback");
        // requestScript.src = requestStr;
      //  alert(requestStr);
         var scriptTag = document.createElement('SCRIPT');
         scriptTag.src = requestStr;
         document.getElementsByTagName('HEAD')[0].appendChild(scriptTag);
                  
	
    }

    function SearchCompleted(response)
    {
      //  alert('received callback');
        var errors = response.SearchResponse.Errors;
        if (errors != null)
        {
            // There are errors in the response. Display error details.
            DisplayErrors(errors);
        }
        else
        {
            // There were no errors in the response. Display the
            // Web results.
          //  alert(response);
            DisplayResults(response);
        }
    }

    function DisplayResults(response)
    {
       // alert('dr called');
        var output = document.getElementById(searchControl);
        output.innerHTML="";
        //var resultsHeader = document.createElement("h4");
        var resultsList = document.createElement("ul");
        resultsList.className = "niceul";
       // output.appendChild(resultsHeader);
        output.appendChild(resultsList);
		
		 var paginateList = document.createElement("div");
        paginateList.className = "mainpaginator";
		output.appendChild(paginateList);
    if(response.SearchResponse.Web.Total > 0) {
        var results = response.SearchResponse.Web.Results;
		totalres=response.SearchResponse.Web.Total;
          	        var resultsListItem = null;
        var resultStr = "";
        for (var i = 0; i < results.length; ++i)
        {
            resultsListItem = document.createElement("li");
            resultsList.appendChild(resultsListItem);
            resultStr = "<a target=\"_blank\" href=\""
                + results[i].Url
                + "\">"
                + results[i].Title
                + "</a><br />"
                + '<span class="mdesc">'+ results[i].Description
				+'</span>'+ "<br />";
            
            // Replace highlighting characters with strong tags.
            resultsListItem.innerHTML =ReplaceHighlightingCharacters(
                resultStr,
                "<strong>",
                "</strong>");

				paginateList.innerHTML = compose_paginate(response.SearchResponse.Web.Total)+'<div class="bingbranding">powered by <a href="http://www.bing.com/" title="Bing" target="_new"><img src="/images/bing_logo.png" width="36" height="16" alt="binng" /></a></div>';

				
        }
	}
	if(response.SearchResponse.Web.Total > 0) {
			document.getElementById(cicihead).innerHTML= addCommas(response.SearchResponse.Web.Total) + " " + "Results";
		} else {
			document.getElementById(cicihead).innerHTML= "no Results Found";
			
		}
	openprogress=0;
    }
    
    function ReplaceHighlightingCharacters(text, beginStr, endStr)
    {
        // Replace all occurrences of U+E000 (begin highlighting) with
        // beginStr. Replace all occurrences of U+E001 (end highlighting)
        // with endStr.
        var regexBegin = new RegExp("\uE000", "g");
        var regexEnd = new RegExp("\uE001", "g");
              
        return text.replace(regexBegin, beginStr).replace(regexEnd, endStr);
    }

    function DisplayErrors(errors)
    {
        alert('error');
        var output = document.getElementById(searchControl);
        var errorsHeader = document.createElement("h4");
        var errorsList = document.createElement("ul");
        output.appendChild(errorsHeader);
        output.appendChild(errorsList);
        
        // Iterate over the list of errors and display error details.
        errorsHeader.innerHTML = "Errors:";
        var errorsListItem = null;
        for (var i = 0; i < errors.length; ++i)
        {
            errorsListItem = document.createElement("li");
            errorsList.appendChild(errorsListItem);
            errorsListItem.innerHTML = "";
            for (var errorDetail in errors[i])
            {
                errorsListItem.innerHTML += errorDetail
                    + ": "
                    + errors[i][errorDetail]
                    + "<br />";
            }
            
            errorsListItem.innerHTML += "<br />";
        }
    }
	function fnGetDomain(url) {
   return url.match(/:\/\/(.[^/]+)/)[1];
}
function switch_respage(whatpage)
{
//	alert(lsavestr);
whatpage=parseInt(whatpage);
if(whatpage==1)
{
curentlastspos=0;
Search(lsavestr);
}
else if(whatpage==2)
{
curentlastspos=5;
Search(lsavestr);
}
else if(whatpage==3)
{
curentlastspos=10;
Search(lsavestr);
}
else if(whatpage==4)
{
curentlastspos=15;
Search(lsavestr);
}
else if(whatpage==5)
{
curentlastspos=20;
Search(lsavestr);
}
else if(whatpage==6)
{
curentlastspos=25;
Search(lsavestr);
}
else if(whatpage==7)
{
curentlastspos=30;
Search(lsavestr);
}
else if(whatpage==8)
{
curentlastspos=35;
Search(lsavestr);
}
else 
{
alert('unknown page');
curentlastspos=0;
Search(lsavestr);
}
var t=setTimeout(function(){change_pcolorl(whatpage)},1000);;
}


function change_pcolorl(whatpage)
{
whatpage=parseInt(whatpage);
var j;
var tempid="plk"+whatpage;
//alert('pageid '+tempid);
document.getElementById(tempid).className='paglinksA';
}

    function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
    </script>
 <link rel="stylesheet" href="header_include/header_style.css" type="text/css" media="screen" />
    <!--[if IE]><script language="javascript" type="text/javascript" src="./flot/excanvas.min.js"></script><![endif]-->
  <?php include('sb_head_include.php'); ?>
    
</head>



<body onload="onLoadProcess();">


<?php require_once ("stuff/navigation.php"); ?>



		<div id="main_content">
		
		<br><p class="llttr" style="margin-top:10px;" ><?php echo _("Step 1: Enter a URL to research:");?>
		
		</p>
			<div class="grennerline"></div>
			<div id="url">
				<input type="text" id="typedURL" name="typedURL" maxlength="512" onkeydown="if(event.keyCode==13) { doWhoisAjax( document.getElementById('typedURL').value ); return false; }" />
				<img id="btn_go" src="images/btn_go.png" alt="go" onclick="doWhoisAjax( document.getElementById('typedURL').value ); return false;" />
				<img id="btn_clear" src="images/btn_clear.png" alt="clear" onclick="clearAll(); return false;" />
				<!-- submit by ENTER --><input style="display:none;" type="submit" onclick="doWhoisAjax( document.getElementById('typedURL').value ); return false;" />
			</div>
            <div class="grennerline"></div>
            <div id="whois_error2" style="display:none"></div>
            <div id="hugecontainer" style=" opacity:0.25; display:none;">
            <div id="lhugecontainer">
            <!--steper 2 start-->
            <div class="jquerryhelper" style="position:relative">
            <div class="titlestep"><span class="llttr"><?php echo _("Step 2: What kind of site is it?");?></span> <input id="niceminbut2" class="niceminbut" type="image" src="images/minbutt.png" alt="minimize info" align="absmiddle" width="22" height="22" border="0" onclick="trickymin(2);" /></div>
            <div class="blueline"></div>
            <div id="sc2" class="scgeneral" style="display:none; opacity:0.25 ; left:455px" ><span id="s2corg"></span><span id="s2ctext"></span></div>
</div>
<!--steper 2 end-->

      <!--steper 3 start-->
      <div class="jquerryhelper" style="position:relative">
            <div class="titlestep"><span class="llttr"><?php echo _("Step 3: What can you learn about its ownership?");?></span> <input id="niceminbut3" class="niceminbut" type="image" src="images/minbutt.png" alt="minimize info" align="absmiddle" width="22" height="22" border="0" onclick="trickymin(3);" /></div>
            <div class="blueline"></div>
            <div id="sc3" class="scgeneral" style="display:none; opacity:0.25 ; left:455px"><?php echo _('<span id="s3link"></span>This information tells you about who registered and owns the domain name you entered. When the screen appears, you can highlight text to search for more information.');?></div>
</div>
<!--steper 3 end-->

      <!--steper 4 start-->
      <div class="jquerryhelper" style="position:relative">
            <div class="titlestep"><span class="llttr"><?php echo _("Step 4: What can you learn from its history?");?></span> <input id="niceminbut4" class="niceminbut" type="image" src="images/minbutt.png" alt="minimize info" align="absmiddle" width="22" height="22" border="0" onclick="trickymin(4);" /></div>
            <div class="blueline"></div>
            <div id="sc4" class="scgeneral" style="display:none; opacity:0.25 ; left:455px"><?php echo $contentstep4l.'<span id="s4link"></span>'._('? Can you find anything in a former version of a web site that tells you more about the owners intent?');?></div>
</div>
<!--steper 4 end-->

      <!--steper 5 start-->
      <div class="jquerryhelper" style="position:relative">
            <div class="titlestep"><span class="llttr"><?php echo _("Step 5: Reference Materials");?></span> <input id="niceminbut5" class="niceminbut" type="image" src="images/minbutt.png" alt="minimize info" align="absmiddle" width="22" height="22" border="0" onclick="trickymin(5);" /></div>
            <div class="blueline"></div>
            <div id="sc5" class="scgeneral" style="display:none; opacity:0.25 ; left:455px"><?php echo _('<span id="s5link"></span> can be helpful, too. Wikipedia does not have central editing and fact checking oversight, but its contributors cover a wide range of of organizations and it contains information about many public, educational, and commercial sites. What can you learn by looking here?');?></div>
</div>
<!--steper 5 end-->

      <!--steper 6 start-->
      <div class="jquerryhelper" style="position:relative">
            <div class="titlestep"><span class="llttr"><?php echo _("Step 6: Who else links to it?");?></span> <input id="niceminbut6" class="niceminbut" type="image" src="images/minbutt.png" alt="minimize info" align="absmiddle" width="22" height="22" border="0" onclick="trickymin(6);" /></div>
            <div class="blueline"></div>
            <div id="sc6" class="scgeneral" style="display:none; opacity:0.25 ; left:455px"><?php echo _('<span id="s6link"></span>What kinds of sites are they? Are they reputable, or not? What does this tell you about the site?');?></div>
</div>
<!--steper 6 end-->

      <!--steper 7 start-->
      <div class="jquerryhelper" style="position:relative">
            <div class="titlestep"><span class="llttr"><?php echo _("Step 7: Print or Download");?></span> <input id="niceminbut7" class="niceminbut" type="image" src="images/minbutt.png" alt="minimize info" align="absmiddle" width="22" height="22" border="0" onclick="trickymin(7);" /></div>
            <div class="blueline"></div>
            <div id="sc7" class="scgeneral" style="display:none; opacity:0.25 ; left:455px">
            <div id="s7sl1">
			<?php echo _('Print or save the information you need. Select your notes and/or the WhoIs report, and whether you want to print them or save them as a PDF to your desktop.');?>
            </div>
            <div id="s7sl2">
            <input id="opt1" type="checkbox" value="1" checked /><span class="textafteropt"><?php echo _('My Text Entry'); ?></span>
            </div>
              <div id="s7sl3">
            <input id="opt2" type="checkbox" value="1" checked /><span class="textafteropt"><?php echo _('Site ownership(whois)'); ?></span>
            </div>
                         <div class="comandstep">
<span id="printerbut"><input  type="image" src="images/printerrr.png" alt="print" width="46" height="49" border="0" onclick="custom_print();" />&nbsp;<?php echo _("Print"); ?></span>
<span id="savebtrn"><input  type="image" src="images/saverb.png" alt="save" width="46" height="49" border="0" onclick="custom_pdf();" /> &nbsp;<?php echo _("Save"); ?></span>
 </div>
            </div>

</div>
<!--steper 7 end-->

            
            </div><!--lhugecontainer-->
            
            <div id="rhugecontainer">
            <div id="teditor1"><?php echo _("Use this space to write notes about what you find. You can save or print this information in Step 7."); ?></div>  
        <textarea id="editor1"></textarea>   
            </div><!--rhugecontainer-->
            
            
            </div><!--hugecontainer-->

			
<input id="textfor_com" type="hidden" value="<?php echo $textfor_com ;?>" />
<input id="textfor_net" type="hidden" value="<?php echo _("These are usually, but not always, used by information networks or network providers.");?>" />
<input id="textfor_org" type="hidden" value="<?php echo _("These are usually, but not always, used by nonprofit organizations.");?>" />
<input id="textfor_edu" type="hidden" value="<?php echo _("These are registered by schools and other approved educational institutions.");?>" />
<input id="textfor_gov" type="hidden" value="<?php echo _("These domains are owned by the government.");?>" />
<input id="textfor_info" type="hidden" value="<?php echo _("These domains are used to identify informational sites, and are usually commercial in nature.");?>" />
<input id="textfor_other" type="hidden" value="<?php echo _("We don't have information about this kind of site.");?>" />
<input id="textfor_us" type="hidden" value="<?php echo _("Although anyone may register these domains, they are usually used by state and local governments.");?>" />
<input id="step3lnktext" type="hidden" value="<?php echo _(" Whois Information");?>" />
<input id="step4lnktext" type="hidden" value="<?php echo _(" history");?>" />
<input id="step5lnktext" type="hidden" value="<?php echo _(" References");?>" />
<input id="step6lnktext" type="hidden" value="<?php echo _(" sites that link here.");?>" />

		<!-- help modal content -->
		<!-- http://www.ericmmartin.com/projects/simplemodal/ -->
		<div id="modalhelp">
					<h3>Help!</h3>
<br/>
<p><u>What is this information?</u></p>
<br/>
<p>Whois information is information that companies who run the Web have about the owners of individual websites.</p>
<br/>
<p>Within the Whois information about a site, Registrant, Administrative or Technical Contact are most helpful at the beginning. Highlight the names, addresses or e-mail addresses to perform an automatic search on the information. Read more about <a href="http://www.gleanwhois.org/help-whois.php">how to plan your research</a> about a website. </p>
<br/>
<p><u>What do I do with the results?</u></p>
<br/>
<p>Use the WhoIs information as a starting point to learn what you can about the domain you are researching.</p>
<br/>
<p>Read more about how to <a href="http://www.gleanwhois.org/help-whois.php">make the best use of this information</a>. Or, if you like to explore on your own, don't forget to employ the Wikipedia and the Website History links, too!</p>
<br/>
<p><u>How do I know I've found everything?</u></p>
<br/>
<p>Your work is finished only when you believe you've learned what you need to know. Usually, you can ask yourself: based upon what I know, do I find this source trustworthy? Do I need to look further?</p>
<br/>


				
					<!--<p><code>$('#basicModalContent').modal(); // jQuery object - this demo</code></p>-->
<!--				</div>
			</div>-->
		</div>

<div id="modal-core" style="display:none; width:906px; height:720px;">
<div class="llttr" style="margin-top:10px;"><?php echo _("Ownership Results"); ?>		
		</div>
        <div class="grennerline"></div>
        <div class="llttrb" style="margin-top:10px; margin-bottom: 10px;"> <?php echo _("<div style='margin: 4px'><p>The information in the  Registration and Search results box show who owns, administers, and serves as the technical contact for the domain. <i>Sometimes, this information is hidden on purpose.</i></p></div>"); ?>		
		</div>
             <div class="jquerryhelper" style="position:relative; width:905px; float:left;">
              <div class="titlestep" style="float:left;"><span class="llttr"><?php echo _("<div style='margin-left: 4px'>Questions to ask</p></div>"); ?></span> <input id="niceminbut911" class="niceminbut" type="image" src="images/minbutt.png" alt="minimize info" align="absmiddle" width="22" height="22" border="0" onclick="trickymin(91);"></div>
            <div class="blueline" style="float:left;"></div>
            <div id="sc91" class="scgenerallong" style="float:left;display:none;opacity:0.25 ; left:455px">
           <?php echo _("<div style='margin-left: 4px'><p>What does WhoIs tell you about the owner? Is the owner an individual, a company, or another third party? Is the owner choosing to stay private? Why might someone make that choice? Is this an old or new registration? Does the ownership suggest anything about the site's content? </p></div>"); ?>
            </div>
</div>
<div style="clear:both"></div>
     <div class="jquerryhelper" style="position:relative; width:905px; float:left;">
              <div class="titlestep" style="float:left;"><span class="llttr"><?php echo _("<div style='margin-left: 4px'>Summary of WhoIs Information</p></div>"); ?></span> <input id="niceminbut9" class="niceminbut" type="image" src="images/minbutt.png" alt="minimize info" align="absmiddle" width="22" height="22" border="0" onclick="trickymin(9);"></div>
            <div class="blueline" style="float:left;"></div>
            <div id="sc9" class="scgenerallong" style="float:left;display:none;opacity:0.25 ; left:455px">
           <?php echo _("<div style='margin-left: 4px'><p>Domain Name - Confirms the name of the domain you are looking at.<br/>Created on/updated/expiration: When registration first happened/was last updated/expires.<br/>Sponsoring registrar - The company through which the domain was registered.<br/>Registrant name/email - The name/email of the person who registered the domain.<br/>Admin Name/Admin email- The person/email who administrates the domain.<br/>Tech Name/Tech email- The technical contact/email for the domain.<br/>Name Server - The machine that matches the name with an actual IP address.<br/> </p></div>"); ?>
            </div>
</div>
<div style="clear:both"></div>
<div class="llttrb" style="margin-top:10px; margin-bottom:4px;"><?php echo _("<div style='margin-left: 4px'>Registration and Search Results:</div>"); ?>		
		</div>
        <div style="clear:both"></div>
			<div id="results">

				<div id="whois">
					<div id="whois_header"><?php echo _("<div style='margin-left: 4px'>Ownership</div>"); ?></div>
					<div id="whois_data">data</div>
					<div id="whois_whole">dirt</div>
					<div id="whois_glitch">glitch</div>
					<div id="whois_error">error</div>
					<div id="whois_loader"><img src="images/loader2.gif" alt="loader" /></div><!-- http://ajaxload.info/ -->
				</div>

				<div id="goog">
					<div id="goog_header"><?php echo _("Your Search Results"); ?></div>
					<div id="goog_data"></div>
					
				</div>

			</div><!-- results -->
             <div style="position:relative; float:left; width:100%;text-align: center; font-size: 10px;">Copyright (c) The Public Learning Media Laboratory, 2010. Read our <a href="http://www.plml.org/privacy-policy" target="_blank">privacy policy</a>. </div>
</div><!--modal core-->

<div id="printable" style="display:none; width:906px; height:720px;">
<div id="printertitlemain"><?php echo _("Glean WhoIs Research Report"); ?></div>
<div id="printertitlesite"><?php echo _("Site:"); ?></div>
<div id="printercontentsite"></div>
<div id="printertitlefindings"><?php echo _("Findings:"); ?></div>
<div id="printercontentfindings"></div>
<div id="printertitlewhoisdata"><?php echo _("Glean WhoIs Research Report"); ?></div>
<div id="printercontentwhoisdata"></div>
</div><!--printabale div-->
<div style="display:none">
<form id="form1" method="post" target="_blank" action="pdfexport.php" runat="server">
<textarea name="forpdfexp" id="forpdfexp" ></textarea>
</form>
</div>
		</div><!-- main_content -->

	</div>

	<script type="text/javascript">

		$("#whois_data").mouseup(function()	// process text highlighting by mouse
		{
			var t = '';
			if( window.getSelection ){
				t = window.getSelection();
			}else if( document.getSelection ){
				t = document.getSelection();
			}else if( document.selection ){
				t = document.selection.createRange().text;
			}

			if( "" != t )
			{
				var sss = String( t );	// can't get the length of the text in other way :|
				if( 35 < sss.length ) // maximum amount of text for the search
				{
					resetGoogleContent();
				}
				else
				{
					googleQuery = t;
					doGoogle( "'" + t + "'" );
				}
			}
		});

		function showModalHelp()
		{
			$('#modalhelp').modal({
				overlayId: 'modalhelp-overlay',
				containerId: 'modalhelp-container'
			});
			//$.modal("<div><h1>SimpleModal</h1></div>");
		}
		
			function jumpmodal ()
		{
	
			
				$("#modal-core").modal({
		opacity:25,
		overlayCss: {backgroundColor:"#515151"},
				onShow: function (dialog) {
			//dialog.container.draggable();
		}
		});	
		}
		
		

	</script>

   


<script type="text/javascript">
//some globals
var textfor_com=document.getElementById("textfor_com").value;
var textfor_net=document.getElementById("textfor_net").value;
var textfor_org=document.getElementById("textfor_org").value;
var textfor_edu=document.getElementById("textfor_edu").value;
var textfor_gov=document.getElementById("textfor_gov").value;
var textfor_info=document.getElementById("textfor_info").value;
var textfor_other=document.getElementById("textfor_other").value;
var textfor_us=document.getElementById("textfor_us").value;
var step3lnktext=document.getElementById("step3lnktext").value;
var step4lnktext=document.getElementById("step4lnktext").value;
var step5lnktext=document.getElementById("step5lnktext").value;
var step6lnktext=document.getElementById("step6lnktext").value;

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-3421032-13']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  //$("#goog").fadeOut(200);
  function trickymin(someid)
  {
	 // alert(someid);
	  var targett="#sc"+someid;
	   var targett2="sc"+someid;
reset_stages(someid);
	   if(document.getElementById(targett2).style.display!="none")
	   {
	 // $(targett).fadeOut(300);
	
	 $(targett).animate({
    opacity: 0.25,
    left: '+=455',
    height: 'toggle'
  }, 600, function() {
    // Animation complete.
  });

   	 var formerf1="niceminbut"+someid;
  document.getElementById(formerf1).src="images/minbutt.png";

	   }
	   else
	   {
	
   // $(targett).fadeIn(800);
	//alert("new one");
	//document.getElementById(targett2).style.display="inline-block";
	 $(targett).animate({
    opacity: 1,
    left: '-=455',
    height: 'toggle'
  }, 600, function() {
    // Animation complete.
  });
		  var formerf2="niceminbut"+someid;
	  document.getElementById(formerf2).src="images/minbuttd.png";
  
	   }
  }//trickymin(someid)

</script>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1',
		{
			toolbar :
			[
				[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ]
			]
		});
//]]>
//here we go a jquerry printpluin
// Create a jquery plugin that prints the given element.
jQuery.fn.print = function(){
// NOTE: We are trimming the jQuery collection down to the
// first element in the collection.
if (this.size() > 1){
this.eq( 0 ).print();
return;
} else if (!this.size()){
return;
}
 
// ASSERT: At this point, we know that the current jQuery
// collection (as defined by THIS), contains only one
// printable element.
 
// Create a random name for the print frame.
var strFrameName = ("printer-" + (new Date()).getTime());
 
// Create an iFrame with the new name.
var jFrame = $( "<iframe name='" + strFrameName + "'>" );
 
// Hide the frame (sort of) and attach to the body.
jFrame
.css( "width", "1px" )
.css( "height", "1px" )
.css( "position", "absolute" )
.css( "left", "-9999px" )
.appendTo( $( "body:first" ) )
;
 
// Get a FRAMES reference to the new frame.
var objFrame = window.frames[ strFrameName ];
 
// Get a reference to the DOM in the new frame.
var objDoc = objFrame.document;
 
// Grab all the style tags and copy to the new
// document so that we capture look and feel of
// the current document.
 
// Create a temp document DIV to hold the style tags.
// This is the only way I could find to get the style
// tags into IE.
var jStyleDiv = $( "<div>" ).append(
$( "style" ).clone()
);
 
// Write the HTML for the document. In this, we will
// write out the HTML of the current element.
objDoc.open();
objDoc.write( "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">" );
objDoc.write( "<html>" );
objDoc.write( "<body>" );
objDoc.write( "<head>" );
objDoc.write( "<title>" );
objDoc.write( document.title );
objDoc.write( "</title>" );
objDoc.write( jStyleDiv.html() );
objDoc.write( "</head>" );
objDoc.write( this.html() );
objDoc.write( "</body>" );
objDoc.write( "</html>" );
objDoc.close();
 
// Print the document.
objFrame.focus();
objFrame.print();
 
// Have the frame remove itself in about a minute so that
// we don't build up too many of these frames.
setTimeout(
function(){
jFrame.remove();
},
(60 * 1000)
);
}
function custom_pdf()
{
	if(document.getElementById('opt1').checked==false && document.getElementById('opt2').checked==false )
	{
		return false;
	}
		if(document.getElementById('opt1').checked==false)
	{//
		//alert(" no have findings");
	document.getElementById("printertitlefindings").innerHTML="";
	document.getElementById("printercontentfindings").innerHTML="";

	}
	else
		{//
		CKEDITOR.instances.editor1.updateElement();
		//alert(document.getElementById('editor1').value);
	document.getElementById("printercontentfindings").innerHTML=document.getElementById('editor1').value;

	}
	
			if(document.getElementById('opt2').checked==false)
	{//
		//alert(" no have whois");
	document.getElementById("printercontentwhoisdata").innerHTML="";

	}
	else
		{//
			//	alert(document.getElementById("whois_data").innerHTML);
	document.getElementById("printercontentwhoisdata").innerHTML=document.getElementById("whois_data").innerHTML;

	}
		document.getElementById("printercontentsite").innerHTML=document.getElementById("typedURL").value;
	var t2=setTimeout("copyprint();",800);
}
function copyprint()
{
	document.getElementById("forpdfexp").value=document.getElementById("printable").innerHTML;
	var t3=setTimeout("submitpdf();",800);
}
function submitpdf()
{
	var myForm = document.getElementById('form1');
        myForm.target = '_self';
        myForm.submit();
}
function custom_print ()
{
	if(document.getElementById('opt1').checked==false && document.getElementById('opt2').checked==false )
	{
		return false;
	}
		if(document.getElementById('opt1').checked==false)
	{//
		//alert(" no have findings");
	document.getElementById("printertitlefindings").innerHTML="";
	document.getElementById("printercontentfindings").innerHTML="";

	}
	else
		{//
		CKEDITOR.instances.editor1.updateElement();
		//alert(document.getElementById('editor1').value);
	document.getElementById("printercontentfindings").innerHTML=document.getElementById('editor1').value;

	}
	
			if(document.getElementById('opt2').checked==false)
	{//
		//alert(" no have whois");
	document.getElementById("printercontentwhoisdata").innerHTML="";

	}
	else
		{//
			//	alert(document.getElementById("whois_data").innerHTML);
	document.getElementById("printercontentwhoisdata").innerHTML=document.getElementById("whois_data").innerHTML;

	}
		document.getElementById("printercontentsite").innerHTML=document.getElementById("typedURL").value;
	var t=setTimeout("helperprint();",1400);
}//function end
function helperprint(){
// Print the DIV.
$( "#printable" ).print();
}
</script>
<?php  //include('sb_body_include.php'); ?>
</body>

</html>