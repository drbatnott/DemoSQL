<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Create a Database</title>
    <?php
        function CreateDatabase(){
        /*
        To allow a connection to an Exception there has to be 
        something to make the mysqli commands throw an exception
        */
            $server = "localhost";
            $user = "root";
            $password = "";
            $driver = new mysqli_driver();
            $dbase = "ntowns";
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
            try{
                $conn = mysqli_connect($server,$user,$password); 
                $sql = "create database $dbase;";
                mysqli_query($conn,$sql);
            }
            catch(mysqli_sql_exception $e){
                echo "Sorry an Error occured<br/>";
            }
        }
    ?>

</head>
<body>
    <h3>Will be based here</h3>
    If it all works then we will not get any error message!
    <?php CreateDatabase(); ?>
</body>
</html>