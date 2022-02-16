<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Towns by County or Product</title>
    <?php
        require_once('dbasefunctions.php');
        if(isset($_POST['byCounty'])){
            $type = "by County";
            $searchItem = $_POST['county'];
        }
        else{
            $type = "by Product";
            $searchItem = $_POST['product'];
        }
        function SearchForTowns($County){
            $dbase = "ntowns";
            $driver = new mysqli_driver();
            
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;
            try{
                 $conn= SetUpConnection($dbase);
                 echo "<br/>before ". $County ." after escape ";
                 $County = EscapeInput($conn,$County);
                 echo $County . "<br/>";
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
            }
            catch(mysqli_sql_exception $e){
                echo "Sorry an Error occured<br/>";
                return false;
            }
        }
    ?>

</head>
<body>
    <h3>Searching    
    <?php 
        echo $type ." named " . $searchItem;
        if($type == "by County"){
            SearchForTowns($searchItem);
        }
    ?>
    </h3>
</body>
</html>