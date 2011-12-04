<?php

require_once( "parser.php" );

$arr = array( 
//"",
//"",
"Registrant:", 
"Zetta Comunicadores",
"Cra 17 No. 89-41",
"Bogota, 00000",
"CO",
"",
"Domain name: ZETTA.COM",
"",
"Administrative Contact:",
"Sanchez, Camilo regdominios@indexcol.com",
"Cra 17 No. 89-41",
"Bogota, 00000",
"",
"3rer");

function prepareBlockDisclaimerity_( $rows )
{


	// calculate 'disclaimerity' for each row
	$sims = array(); // disclaimer similarity values
	$cnt = count( $rows );
	for( $i=0; $i<$cnt; $i++ )
		array_push( $sims, getDisclaimerSimilarity( $rows[$i] ) );

	///////
	// mark for deleting some strings (blocks)

print_r( $sims );

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
				$med = $sum / $nnn;

				// set common for block values for each row
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

echo "<br/>";
print_r( $sims );
	return $sims;
}


prepareBlockDisclaimerity_( $arr );

?>