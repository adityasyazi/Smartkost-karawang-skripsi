<?php  
function readmore($string){
 	$string = substr($string, 0, 200); 
	$string = $string . "..."; 
	return $string;
}
 ?>