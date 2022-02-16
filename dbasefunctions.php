<?php
    
    function SetUpConnection($db){
        //$db = "towns";
        $server = "localhost";
        $user = "root";
        $pword= "";
        $success = true;
        $driver = new mysqli_driver();
        $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
        try {
            $conn = mysqli_connect($server,$user,$pword,$db);
        } 
        catch(mysqli_sql_exception $e){
            echo "Exception caught " ;//. $e;
            $conn = false;
        }
        return $conn;
    }
	function EscapeInput($conn,$input){
		$escapedInput = $conn->real_escape_string($input);
        return $escapedInput;

	}
	
?>
