<?php 

/***************** PARAMETERS **************/
$DISCLAIMER_SIGN_VALUE = 40;
/*******************************************/

$junkSymbols = array( 9, 10, 11, 13, 32 ); // define stuff which should be removed 
$goodSymbols = array( '.', '+', '(', ')', '@', ':', '-', '/', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ); // these are rare in disclaimer block

//------------------------------------------------------------------------------------------------------------- prepareWhole()
function prepareWhole( $rows )
{
	$whole = "";

	$amnt = count( $rows );
	for( $i=0; $i<$amnt; $i++ )
	{
		//
		$whole .= $rows[$i]."<br/>";
	}

	$whole = baseFix( $whole ); // todo
	
	return $whole;
}


//------------------------------------------------------------------------------------------------------------- baseFix()
function baseFix( $txt )
{
	$txt = str_replace( "<", "[", $txt );
	$txt = str_replace( ">", "]", $txt );
	
	return $txt;
}

//------------------------------------------------------------------------------------------------------------- prepareLinks()
function prepareLinks( $domain )
{
	// dimic: according to Dave's:
	// Eliminate the TLD (.edu, .us etc) from the Wikipedia lookup, such that it’s searching the domain name (e.g., nytimes, google) 
	// rather than the url (nytimes.com, google.com)
	//
	$pos = strrpos( $domain, "." );
	$tail = strlen( $domain ) - $pos;
	$domain4wiki = substr( $domain, 0, -$tail ); // cut the TLD tail

	$links = "<history>http://web.archive.org/web/".$domain."</history>";
	$links .= "<wiki>http://en.wikipedia.org/wiki/".$domain4wiki."</wiki>";

	return $links;
}

//------------------------------------------------------------------------------------------------------------- fixDomain()
function fixDomain( $domainWithStuff, $bWHOISserver=false )
{
	$domain = strtolower( trim( $domainWithStuff ) );
		$domain = str_replace( "whois server:", '', $domain ); // in case we exract server for some COM/NET/EDU
	$domain = preg_replace( '/^http:\/\//i', '', $domain );
	$domain = preg_replace( '/^www\./i', '', $domain );
	$domain = explode( '/', $domain );
	$domain = trim( $domain[0] );

	if( !$bWHOISserver )
	{
		// [2010.Dec.09]
		// Add the ability to parse long domain names, e.g., http://apgovernment.greenwich.wikispaces.com should be parsed as http://www.wikispaces.com.
		//
		$domain = explode( '.', $domain );
		$cnt = count( $domain );
		$domain = trim( $domain[$cnt-2] ) . "." . trim( $domain[$cnt-1] );
	}

	return $domain;
}
































//------------------------------------------------------------------------------------------------------------- prepareData()
function prepareData( $rows )
{
	//
	$clean = trimRows( $rows );

	$clean = filterRowsStartingByPercent( $clean );

	if( count( $clean ) == count( $rows ) )	// failed; nothing changed...
	{
		// ...so continue additional cleaning

		// remove disclaimer
		$clean = filterDisclaimer( $clean );

		// remove advert
		$clean = filterAdvert( $clean );
	}

	//
	return baseFix( mergeRows( $clean ) );
}

//------------------------------------------------------------------------------------------------------------- trimRows()
// trim every string
function trimRows( $rows )
{
	//
	$trimed = array();
	$cnt = count( $rows );
	for( $i=0; $i<$cnt; $i++ )
	{
		//
		$ss = trimmA( $rows[$i] );
		$ss = trimmZ( $ss );
		$trimed[$i] = $ss;
	}

	return $trimed;
}


//------------------------------------------------------------------------------------------------------------- filterRowsStartingByPercent()
// removes only rows that starts in any but '%' symbol
function filterRowsStartingByPercent( $rows )
{
	//
	$cnt = 0;
	$arrCleaned = array();

	$nn = count( $rows );
	for( $i=0; $i<$nn; $i++ )
	{
		$first = substr( $rows[$i], 0, 1 );
		if( 0 != strcmp( "%", $first ) )
		{
			$arrCleaned[$cnt] = $rows[$i];
			$cnt++;
		}
	}

	return $arrCleaned;
}


//------------------------------------------------------------------------------------------------------------- str2array()
// takes a string and then returns an array (per symbol)
function str2array( $str )
{
	// 
	$arr = array();
	$nn = strlen( $str );
	
	for( $i=0; $i<$nn; $i++ )
		$arr[$i] = substr( $str, $i, 1 );

	return $arr;
}

//------------------------------------------------------------------------------------------------------------- mergeRows()
// build a single string from a set of rows
function mergeRows( $rows, $delim="<br/>" )
{
	//
	$res = "";
	$cnt = count( $rows );
	$nl = 0;
	for( $i=0; $i<$cnt; $i++ )
	{
		// 
		if( !empty( $rows[$i] ) )
		{
			//
			if( 0 < $nl )
			{
				$res .= $delim;
				$nl=0;
			}

// $zz = getDisclaimerSimilarity( $rows[$i] );
// $res = gluee( $res, "{".$zz."} ".$rows[$i], $delim );

			$res = gluee( $res, $rows[$i], $delim );
		}
		else
		{
			if( empty( $res ) ) continue; // no any emptyness on the borders

			$nl++;
		}
	}

	return $res;
}


//------------------------------------------------------------------------------------------------------------- trimmA()
// removes all non-visible charaters (like 'space', 'new-line' etc) on the BEGINNING
function trimmA( $str )
{
	global $junkSymbols;

	if( empty( $str ) ) return $str; // do not torture an empty string any more

	//
	$ord = ord( substr( $str, 0, 1 ) );

	// is this first character one the the 'junk'?
	$cnt = count( $junkSymbols );
	for( $i=0; $i<$cnt; $i++ )
		if( $ord == $junkSymbols[$i] )
		{
			return trimmA( substr( $str, 1 ) );
		}

	return $str;
}

//------------------------------------------------------------------------------------------------------------- trimmZ()
// removes all non-visible charaters (like 'space', 'new-line' etc) on the END
function trimmZ( $str )
{
	global $junkSymbols;

	if( empty( $str ) ) return $str; // do not torture an empty string any more

	//
	$len = strlen( $str );
	$ord = ord( substr( $str, $len-1 ) );

	// is this first character one the the 'junk'?
	$cnt = count( $junkSymbols );
	for( $i=0; $i<$cnt; $i++ )
		if( $ord == $junkSymbols[$i] )
		{
			return trimmZ( substr( $str, 0, $len-1 ) );
		}

	return $str;
}

//------------------------------------------------------------------------------------------------------------- gluee()
function gluee( $str1, $str2, $delimiter="<br/>" )
{
	if( empty( $str1 ) )
		return $str2;
	else if( empty( $str2 ) )
		return $str1;

	return ( "".$str1.$delimiter.$str2."" );
}

//------------------------------------------------------------------------------------------------------------- filterDisclaimer()
// removes 'disclaimer' defined as a lot of long rows
function filterDisclaimer( $rows )
{
	global $DISCLAIMER_SIGN_VALUE;

	$clean = array(); // disclaier similarity values
	$cnt = count( $rows );

	$disci = prepareBlockDisclaimerity( $rows );

	for( $i=0; $i<$cnt; $i++ )
	{
		//
		if( $DISCLAIMER_SIGN_VALUE < $disci[$i] || 
				-110 == $disci[$i] )
			array_push( $clean, $rows[$i] );
	}

	return $clean;
}

//------------------------------------------------------------------------------------------------------------- prepareBlockDisclaimerity()
function prepareBlockDisclaimerity( $rows )
{
	global $currentTLD;

	$byTLD = 1;
	// 1 < $byTLD - rather 'useful' informarion
	// 1 > $byTLD - rather junk
	if( 0 != strcmp( "us", $currentTLD ) )
	{
		$byTLD = 10;
	}

	// calculate 'disclaimerity' for each row
	$sims = array(); // disclaimer similarity values
	$cnt = count( $rows );
	for( $i=0; $i<$cnt; $i++ )
		array_push( $sims, getDisclaimerSimilarity( $rows[$i] ) );

	///////
	// mark for deleting some strings (blocks)

	$begin = -1;
	$end = -1;
	//
	for( $i=0; $i<$cnt; $i++ )
	{
		//
		if( -110 == $sims[$i] || ($i+1) == $cnt )
		{
			if( -1 < $begin && 1 < ( $i - $begin) ) // block consists of at least two rows
			{
				if( ($i+1) == $cnt && -110 != $sims[$i] ) // if this is the end - then modify block together with the latest (current) symbol
					$add = 1;
				else
					$add = 0;

				$end = $i; // current block end

				// review the (gather statistic) block....
				$sum = 0;
				$nnn = 0;
				for( $j=$begin; $j<($i+$add); $j++ )
				{
					$sum += $sims[$j];
					$nnn++;
				}

				// define the medium
				$med = ( $sum / $nnn ) * $byTLD;

				// set block common value for each row
				for( $j=$begin; $j<($i+$add); $j++ )
					$sims[$j] = $med;
			}
			else if( -110 != $sims[$i] && $cnt == (1+$i) )	// process single-row here
				$sims[$i+1] = 444;


			// reset
			$end = -1;
			$begin = -1;
		}
		else
		{
			if( -1 == $begin )
			{
				if( -110 == $sims[$i+1] )	// process single-row here
					$sims[$i] = 444;

				$begin = $i; // current block beginning
			}

		}
	}

	return $sims;
}

//------------------------------------------------------------------------------------------------------------- getDisclaimerSimilarity()
// gets the similarity (a value) how much the string similar to disclaimer text
// lower value - more likely disclaimer
function getDisclaimerSimilarity( $str )
{
	global $goodSymbols;

	if( empty( $str ) ) return -110;	// special 'magic' mark

	//
	$strArr = str2array( $str );
	$cnti = count( $strArr );
	$cntj = count( $goodSymbols );
	$found = 0;
	for( $i=0; $i<$cnti; $i++ )
	{
		for( $j=0; $j<$cntj; $j++ )
		{
			if( $strArr[$i] == $goodSymbols[$j] )
			{
				// some additional checks..

				// 1. dot in the end of string doesn't seem interesting fo us
				if( '.' == $strArr[$i] )
				{
					// so check if the next symbol exists and either letter or number
					if( $i+1 >= $cnti ) continue;
					$ord = ord( $strArr[$i+1] );
					if( ( $ord > 47 && $ord < 58 ) || ( $ord > 64 && $ord < 91 ) || ( $ord > 96 && $ord < 123 ) || ( 46 == $ord ) ) // 0-9 || A-Z || a-z || .
						$found++;
				}

				else/**/
					$found++;
			}
		}
	}

	$charQuality = ceil( 10000 * $found / $cnti / $cnti );

	return $charQuality;
}







//------------------------------------------------------------------------------------------------------------- filterAdvert()
function filterAdvert( $rows )
{
	// todo :)
	return $rows;
}

// long
// few 'good' symbols
// the same 'shit' before and/or after
// ! could be delimited by new-line !


?>
