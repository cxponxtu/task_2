<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
if ($_SESSION["status"] != 1) 
{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gemini Club Inductions</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
    <?php
    include("header.php");
    $duser=getenv("MYSQL_USER");
    $dpass=getenv("MYSQL_PASSWORD");
    $dhost=getenv("MYSQL_HOST");
    $dbname="gemini";
    $conn = mysqli_connect($dhost,$duser,$dpass,$dbname);
    require("admin.php");
    require("mentee.php");
    require("mentor.php");
    
    $home = 1;
    if(!empty($_POST["back"]))
    {
        $home = 1;
    }
    if(!empty($_POST["back2"]))
    {
        $home = 0;
        echo "<form action=\"home.php\" method=\"post\"><input name=\"back\" class=\"back\" type=\"submit\" value=\"Back\" ></form>";
        echo "<h2 id=\"detail\">Showing details of {$_SESSION["mentor_admin"]}</h2>";
        mentor($conn,$_SESSION["mentor_admin"]);
    }
    if(!empty($_POST["navigate"]))
    {
        $home = 0;
        $_SESSION["mentor_admin"] = $_POST["navigate"];
        echo "<form action=\"home.php\" method=\"post\"><input name=\"back\" class=\"back\" type=\"submit\" value=\"Back\" ></form>";
        echo "<h2 id=\"detail\">Showing details of {$_POST["navigate"]}</h2>";
        mentor($conn,$_POST["navigate"]);
    }
    if(!empty($_POST["mentee"]))
    {
        if($_SESSION["permission"] == 3)
        {
            $home = 0;
            echo "<form action=\"home.php\" method=\"post\"><input name=\"back2\" class=\"back\" type=\"submit\" value=\"Back\" ></form>";
        }
        else if($_SESSION["permission"] == 2)
        {
            $home = 0;
            echo "<form action=\"home.php\" method=\"post\"><input name=\"back\" class=\"back\" type=\"submit\" value=\"Back\" ></form>";
        }
        echo "<h2 id=\"detail\">Showing details of {$_POST["mentee"]}</h2>";
        mentee($conn,$_POST["mentee"]);
    }
    if(!empty($_POST["navigate2"]))
    {
        $home = 0;
        echo "<form action=\"home.php\" method=\"post\"><input name=\"back\" class=\"back\" type=\"submit\" value=\"Back\" ></form>";
        echo "<h2 id=\"detail\">Showing details of {$_POST["navigate2"]}</h2>";
        mentee($conn,$_POST["navigate2"]);
    }

    if($home == 1)
    {
        switch ($_SESSION["permission"])
        {
            case 1:
                mentee($conn,$_SESSION["user"]);
                break;
            case 2:
                mentor($conn,$_SESSION["user"]);
                break;
            case 3:
                admin($conn);
                break;
        }
    }
mysqli_close($conn);
?>
</body>
</html>