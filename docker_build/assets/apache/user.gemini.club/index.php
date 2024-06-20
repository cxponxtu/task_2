
<!DOCTYPE HTML>
<html>

<head>
<title>User Login</title>
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body >
<form action="index.php" method="post" class="form">
    <h2>Gemini Club Inductions</h2>
    <label for="username">Username</label>
    <input type="text" id="username" name="user"><br>
    <label for="password">Password</label>
    <input type="password" id="pass" name="pass"><br>   
    <input type="submit" name="submit" value="Log In" class="button"> 
    <input type="submit" name="submit"  value="New User" class="button">
    <div id="response">
<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

$duser=getenv("MYSQL_USER");
$dpass=getenv("MYSQL_PASSWORD");
$dhost=getenv("MYSQL_HOST");
$dbname="gemini";
$conn = mysqli_connect($dhost,$duser,$dpass,$dbname);

if(!empty($_POST["submit"]))
{
    $_SESSION["status"] = 0;
    if ($_POST["submit"] == "New User")
    {
        header("Location: user_gen.php");
    }
    $user = $_POST["user"];
    $pass = $_POST["pass"];

    if(!empty($user) && !empty($pass))
    {
        $sql = "SELECT name FROM admin WHERE name = '$user' AND password = '$pass'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $_SESSION["user"] = $user;
            $_SESSION["pass"] = $pass;
            $_SESSION["name"] = mysqli_fetch_assoc($result)["name"];
            $_SESSION["permission"] = 3;
            $_SESSION["status"] = 1;
            $_SESSION["des"] = "Admin";
            header("Location: home.php");
        }
        else
        {
            $sql = "SELECT name FROM mentors WHERE name = '$user' AND password = '$pass'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                $_SESSION["user"] = $user;
                $_SESSION["pass"] = $pass;
                $_SESSION["name"] = mysqli_fetch_assoc($result)["name"];
                $_SESSION["permission"] = 2;
                $_SESSION["status"] = 1;
                $_SESSION["des"] = "Mentor";
                header("Location: home.php");
            }
            else
            {
                $sql = "SELECT name FROM mentees WHERE roll = '$user' AND password = '$pass'";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0)
                {
                    session_start();
                    $_SESSION["user"] = $user;
                    $_SESSION["pass"] = $pass;
                    $_SESSION["name"] = mysqli_fetch_assoc($result)["name"];
                    $_SESSION["permission"] = 1;
                    $_SESSION["status"] = 1;
                    $_SESSION["des"] = "Mentee";
                    header("Location: home.php");
                }
                else
                {
                    echo "Incorrect Username/Password";
                }
            }   
        }
        
    }
    else
    {
        echo "Enter valid Username/Password";
    }
}
if (!empty($_SESSION["status"]) && $_SESSION["status"] == 2) 
{
    echo "Logged out";
}
mysqli_close($conn);
?>
</div>
</form>

</body>
</html>

