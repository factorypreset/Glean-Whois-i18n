<?php

// t o d o:
// error message isn't a language specific
//

ob_start();

// send XML header; as we send data in XML format
header( "Content-Type: application/xml; charset=utf-8" );

require_once( "parser.php" );

//$aaa = $fdfdf; // uncomment this to see how php output (junk) is gathered and then shown in GLITCH section (yellow)

$responseData = "";
$responseWhole = "";
$responseGlitch = ""; // warnings and errors from PHP; rather for debugging/development
$responseError = ""; // our own error message
$responseLinks = ""; // history and wiki
$responseDomain = "";

$rowsAll = array();	// stores all pieces returned from WHOIS server
$rowsClean = array(); // 

$currentTLD = ""; // stores a TLD (e.g. COM, US, UA, NET, EDU etc) in order to use later in received data filtering

// in case if main whois thin server fails we will use one of the next:
//
$whoisReserveThinServers = array(
	"com" => array( "whois.verisign-grs.com", "whois.internic.net", "whois.crsnic.net" ),
	"net" => array( "whois.verisign-grs.com", "whois.internic.net", "whois.crsnic.net" ),
	"edu" => array( "whois.internic.net", "whois.crsnic.net" ) );



define ( "MAX_WAITING_TIME", 7 ); // how long we wait for response from server
//define ( "MAX_WAITING_TIME", ini_get("default_socket_timeout") );

//------------------------------------------------------------------------------------------------------------- whoisQuery()
function getWhoisInfo( $domain )
{
	global $responseDomain, $whoisReserveThinServers;
	global $currentTLD;

	//
	$domain = fixDomain( $domain );
 
	// extract TLD (top level domain) from domain name
	$_domain = explode('.', $domain);
	$lst = count($_domain)-1;
	$tld = $_domain[$lst];

	$nic_server = getServerForTLD( $tld );
	$currentTLD = $nic_server;

	// remember domain
	$responseDomain = $domain;

	// 
	if( "com" == $tld || "net" == $tld || "edu" == $tld )
	{
		// get proper WHOIS server
		$proper = query_whois_server( $nic_server, $domain, true );

		// in case the main thin whois server fails...
		if( empty( $proper ) )
		{
			$cnt = count( $whoisReserveThinServers[$tld] );
			for( $i=0; $i<$cnt; $i++ )
			{
				$proper = query_whois_server( $whoisReserveThinServers[$tld][$i], $domain, true );

				if( !empty( $proper) )
					break;
			}
		}

		if( empty( $proper ) )
			returnXML( "Sorry, we couldn't find information for <b>".$domain."</b> on our servers. Some major domains do not allow their ownership information to be shared publicly." );

		$proper = fixDomain( $proper, true );

		// ask appropriate server about our domain
		return query_whois_server( $proper, $domain );
	}
	else
	{
		// ask server about our domain
		return query_whois_server( $nic_server, $domain );
	}
}

//------------------------------------------------------------------------------------------------------------- getServerForTLD()
// thanks to http://www.jonasjohn.de/snippets/php/whois-query.htm
function getServerForTLD( $tld )
{
	// You find resources and lists like these on wikipedia: http://de.wikipedia.org/wiki/Whois
	//
	$servers = array(
		"com" => "whois.tucows.com",
		"net" => "whois.tucows.com",

		"edu" => "whois.verisign-grs.com",

		"org" => "whois.pir.org",
		"biz" => "whois.neulevel.biz",
		"gov" => "whois.nic.gov",
		"mil" => "rs.internic.net",
		"int" => "whois.iana.org",

		"info" => "whois.nic.info",
		"aero" => "whois.information.aero",
		"coop" => "whois.nic.coop",
		"name" => "whois.nic.name",

		"ac" => "whois.nic.ac",
		"ae" => "whois.uaenic.ae",
		"at" => "whois.nic.at",
		"au" => "whois.aunic.net",
		"be" => "whois.dns.be",
		"bg" => "whois.ripe.net",
		"br" => "whois.registro.br",
		"bz" => "whois.belizenic.bz",
		"ca" => "whois.cira.ca",
		"cc" => "whois.nic.cc",
		"ch" => "whois.nic.ch",
		"cl" => "whois.nic.cl",
		"cn" => "whois.cnnic.net.cn",
		"cz" => "whois.nic.cz",
		"de" => "whois.nic.de",
		"fr" => "whois.nic.fr",
		"hu" => "whois.nic.hu",
		"it" => "nic.it",
		"ie" => "whois.domainregistry.ie",
		"il" => "whois.isoc.org.il",
		"in" => "whois.ncst.ernet.in",
		"ir" => "whois.nic.ir",
		"mc" => "whois.ripe.net",
		"to" => "whois.tonic.to",
		"tv" => "whois.tv",
		"ru" => "whois.ripn.net",
		"nl" => "whois.domain-registry.nl",
		"ua" => "who-is.com.ua",
		"us" => "whois.nic.us", 
		"ro" => "whois.rotld.ro",
	);

	if( !isset( $servers[$tld] ) )
	{
		// stop script work and send an error
		returnXML( "Sorry, we couldn't find information for <b>".$tld."</b> on our servers. [TLD error]" );
	}

	return $servers[$tld];
}

//------------------------------------------------------------------------------------------------------------- query_whois_server()
function query_whois_server( $server, $domain, $bWhoisOnly=false )
{
	global $rowsAll;

	//
	$res = "";

	$errno = 0;
	$errstr = "";

	$cnt = 0;
	$rowsAll = array(); // clear previous content

	// connect to whois server:
	if( $conn = fsockopen( $server, 43, $errno, $errstr, MAX_WAITING_TIME ) )
	{
		fputs( $conn, $domain."\r\n" );
		while( !feof( $conn ) )
		{
			$piece = fgets( $conn, 128 );

			if( true == $bWhoisOnly )
			{
				if( false != strrpos( $piece, "Whois Server:" ) )
					$res .= $piece;
			}
			else
			{
				$res .= $piece."<br/>";
				$rowsAll[$cnt] = $piece;
				$cnt++;
			}
		}

		fclose( $conn );
	}
	else
	{
		if( $bWhoisOnly )
		{
			return "";
		}
		else
		{
			returnXML( "Couldn't connect to <b>".$server."</b> WHOIS server. (".$errno.": ".$errstr.")" );
		}
	}

	return $res;
}

//------------------------------------------------------------------------------------------------------------- returnXML()
function returnXML( $err = "" )
{
	global $responseData, $responseWhole, $responseGlitch, $responseError, $responseLinks, $responseDomain;
	global $rowsAll;

	$responseError = $err;

//echo $rowsAll
//print_r( $rowsAll );
//die;

	// gather any PHP errors/warnings, and then clear buffer
	$responseGlitch = ob_get_contents();
	ob_end_clean();
	ob_end_flush();


	// output the XML data itself
	echo "<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?>";

	// update/construct all the data blocks
	$responseData = prepareData( $rowsAll );
	$responseWhole = prepareWhole( $rowsAll );
	$responseGlitch = baseFix( $responseGlitch );
	$responseError = baseFix( $responseError );
	$responseLinks = prepareLinks( $responseDomain );


	echo "\n<content>";
	echo "\n\t<data>".(empty($responseData) ? "" : $responseData)."</data>";
	echo "\n\t<whole>".(empty($responseWhole) ? "" : $responseWhole)."</whole>";
	echo "\n\t<glitch>".(empty($responseGlitch) ? "" : $responseGlitch)."</glitch>";
	echo "\n\t<error>".(empty($responseError) ? "" : $responseError)."</error>";
	echo "\n\t<links>".(empty($responseLinks) ? "" : $responseLinks)."</links>";
	echo "\n\t<domain>".(empty($responseDomain) ? "" : $responseDomain)."</domain>";
	echo "\n</content>";

	die; // this function can be called from any place (at any time; including as an 'throw') so it should stop everything
}


// ============================================================================================================ \\
if( isset( $_GET['domain'] ) && !empty( $_GET['domain'] ) )
{
	getWhoisInfo( $_GET['domain'] );
	
	returnXML();
}
else
	returnXML( "To begin your research, please enter a URL in the format www.site.com" );

?>