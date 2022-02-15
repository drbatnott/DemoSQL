<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Populating New Table in the Database</title>
    <?php
        function PopulateTableFromTables($fileName){
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
                $myfile = fopen($fileName,"r");
                $count = 1;
                while(!feof($myfile)){
                    $input = fgets($myfile);//Like textReader.ReadLine() in C#
                    if(str_contains($input,",")){
                        $parts = explode(",",$input);
						$newStr = substr_replace($parts[1],"",-2);
							
                        echo $count . " Town *" . $parts[0] . "* Product *". $newStr."*<br/>";

                        $sql = "select ID from mytowns where townName like '$parts[0]'";
                        $count++;//like in C# this is the autoincrement ++
                        //If the query returns a result we can potentially use it
                        if($result = mysqli_query($conn,$sql)){
                            while($row = mysqli_fetch_assoc($result)){         
                                echo $parts[0] ." has ID " . $row['ID'] ."<br/>";
                                $sql1 = "select ID as productID from products where productName like '$newStr';";
                                if($result1 = mysqli_query($conn,$sql1)){
                                    while($row1 = mysqli_fetch_assoc($result1)){ 
                                        echo "product " . $newStr . " has id " . $row1['productID'] . "<br/>";
                                        $sql2 = "insert into townproduces (productID,townID) values (";
                                        $sql2 = $sql2 . $row1['productID'].",".$row['ID'].");";
                                        echo $sql2 ."<br/>";
                                        mysqli_query($conn,$sql2);
                                    }
                                }
                            }
                        }
                    }
                }       
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
    $result = PopulateTableFromTables("products.csv"); 
    echo "the result was $result <br/>";
    ?>
</body>
</html>