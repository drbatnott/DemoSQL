    <?php
        
        function SetupConnection($dbase){
            $server = "localhost";
            $user = "root";
            $password = "";
            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
            try{
                $conn = mysqli_connect($server, $user, $password, $dbase);               
            }
            catch(mysqli_sql_exception $e){
                //echo "Sorry an Error occured<br/>";
                return false;
            }
        }
    ?>

