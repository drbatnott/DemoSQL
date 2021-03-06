<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Populating New Table in the Database</title>
    <?php
        function PopulateTableFromFile($fileName){
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
                //$sql = "create table myTowns (ID int not null AUTO_INCREMENT,";
                //$sql = $sql . " townName VARCHAR(256), county VARCHAR(255), PRIMARY KEY (ID)) ENGINE = InnoDB;";
                //echo $sql ."<br/>"; 
                $myfile = fopen($fileName,"r");
                $count = 1;
                while(!feof($myfile)){
                    $input = fgets($myfile);//Like textReader.ReadLine() in C#
                    if(str_contains($input,",")){
                        $parts = explode(",",$input);
						$newStr = substr_replace($parts[1],"",-1);
							
                        echo $count . " Town *" . $parts[0] . "* County *". $newStr."*<br/>";
                        $sql = "insert into mytowns (townName,county) values ('$parts[0]','$newStr');";
                        $count++;//like in C# this is the autoincrement ++
                        mysqli_query($conn,$sql);
                    }
                    else
                        echo $count . " " . $input ."<br/>";          

                }
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
    $result = PopulateTableFromFile("townsInNcounties.csv"); 
    echo "the result was $result <br/>";
    ?>
</body>
</html>