<?php
include "include/conx.php";		
function check_name($name) {
 $query = "select count(*) from user where
				name = '".$name."' 
													";
					include "include/conx.php";				
$result = mysqli_query($db, $query);
			if(!$result) {
							echo "Cannot run query.";
									exit;
			}
			$row = mysqli_fetch_row($result);
			$count = $row[0];
				
					if ($count > 0) {
					return false;
} else {
						return true;
				}
}

function check_email($email) {
    
     $query = "select count(*) from user where
				email = '".$email."' 
													";
						include "include/conx.php";					
$result = mysqli_query($db, $query);
			if(!$result) {
							echo "Cannot run query.";
									exit;
			}
			$row = mysqli_fetch_row($result);
			$count = $row[0];
				
					if ($count > 0) {
					return false;
} else {
						return true;
				}
}

