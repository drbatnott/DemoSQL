<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Create a New Table in the Database</title>
    <?php
        function CreateDatabaseTable(){
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
                $conn = mysqli_connect($server,$user,$password,$dbase); 
                $sql = "create table myTowns (ID int not null AUTO_INCREMENT,";
                $sql = $sql . " townName VARCHAR(256), county VARCHAR(255), PRIMARY KEY (ID)) ENGINE = InnoDB;";
                echo $sql ."<br/>"; 
                //mysqli_query($conn,$sql);
                return true;
            }
            catch(mysqli_sql_exception $e){
                echo "Sorry an Error occured<br/>";
                return false;
            }
        }
    ?>

</head>
<body>
    <h3>Will be based here</h3>
    If it all works then we will not get any error message!<br/>
    <?php 
    $result = CreateDatabaseTable(); 
    echo "the result was $result <br/>";
    ?>
</body>
</html>