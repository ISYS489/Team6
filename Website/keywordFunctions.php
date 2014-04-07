<?php # keyword functions
//File Name: keywordFunctions.php
//Purpose: This page defines functions used to display keywords.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Cale Kuchnicki
//Last Date Modified: 4/5/2014


//Used on addKeyword.php, createEvent.php
function displayKeywords(){
 	require ('mysqliConnect.php');
		/* multi query statement */
	$keywordQuery = "SELECT MediaTypeId, MediaType FROM mediatypes;SELECT NameId, Name From names;SELECT NewsOutletId, NewsOutlet FROM newsoutlets;SELECT PoliticalPartyId, PoliticalParty FROM politicalparties";
	
	$counter=0; // counter for drop down menu population 0=mediatype 1=name 2=newsoutlet 3=politicalparty
	/* execute multi query */
	if (mysqli_multi_query($dbc, $keywordQuery)) {
	    do {
	        /* begin corresponding select */
	        if ($counter == 0) {
	         	echo "Media Type: ";
				echo "<select name='media_type'>";
			} else if ($counter == 1) {
			 	echo "Person of Interest: ";
				echo "<select name='name'>";
			} else if ($counter == 2){
			 	echo "News Outlet: ";
				echo "<select name='news_outlet'>";
			} else if ($counter == 3){
			 	echo "Political Party: ";
			 	echo "<select name='political_party'>";
			} 
			echo "<option value=''></option>"; //Create a default value
	        /* input corresponding values */
	        if ($result = mysqli_store_result($dbc)) {
	            while ($row = mysqli_fetch_row($result)) {
			         	echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";  		           
	            }  
	            echo "</select></br>";
	        }
	        
	        /* increase counter for next attribute */
	        if (mysqli_more_results($dbc)) {
	            $counter = $counter + 1;
	        }
	    } while (mysqli_next_result($dbc));
	}
	
	echo "</p>";
}

?>