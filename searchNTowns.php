<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Populating New Table in the Database</title>
    <?php
        function SearchForTowns($County){
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
                //in the following statement townName will be returned as name which is called an alias!
                $sql = "select townName as name, county from mytowns where county like '$County';";
                echo $sql . "<br/>";
                echo "Towns in $County are<br/>";
                if($result = mysqli_query($conn,$sql)){
                    while($row = mysqli_fetch_assoc($result)){         
                        echo $row['name'] . " *" .$row['county']. "*<br/>";
                    }
                    return true;
                }
                else {
                    return false;
                }


                //mysqli_query($conn,$sql);
                
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
    $c = "Nottingham%";
    $result = SearchForTowns($c); 
    if($result == true){
        echo "the result was $result <br/>";
    }
    else{
        echo "no towns in $c";
    }
    ?>
</body>
</html>