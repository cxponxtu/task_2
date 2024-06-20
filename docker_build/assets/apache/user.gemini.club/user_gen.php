<!DOCTYPE html>
<html>
<head>
    <title>New User</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">

</head>
<body>
    <form action="user_gen.php" method="post" class="form">
        <h2>New User</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="user"><br>
        <label for="pass">New Password</label>
        <input type="password" id="pass" name="pass"><br>   
        <label for="pass2">Again New Password</label>
        <input type="password" id="pass2" name="pass2"><br> 
        <input type="submit" name="submit"  value="Create User" class="button">
        <input type="submit" name="submit"  value="Login" class="button">
        <div id="response">
        <?php

$duser=getenv("MYSQL_USER");
$dpass=getenv("MYSQL_PASSWORD");
$dhost=getenv("MYSQL_HOST");
$dbname="gemini";
$conn = mysqli_connect($dhost,$duser,$dpass,$dbname);

if(!empty($_POST["submit"]))
{   
    if($_POST["submit"] == "Login")
    {
        header("Location: index.php");
    }
    $user=$_POST["user"];
    $pass=$_POST["pass"];
    $pass2=$_POST["pass2"];
    if(!empty($user && !empty($pass) && !empty($pass2)))
    {
        if($pass == $pass2)
        {   
            $sql = "SELECT * FROM mentors WHERE name = '$user'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_assoc($result);
                if (empty($row["password"])) 
                {
                    $sql="UPDATE mentors SET password = '$pass' WHERE name = '$user'";
                    mysqli_query($conn,$sql);
                    mysqli_commit($conn);
                    echo '<script>alert("User added. You can login.")</script>';
                }
                else
                {
                    echo "User already exists";
                }
            }
            else 
            {
                $sql = "SELECT * FROM mentees WHERE roll = '$user'";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_assoc($result);
                    if (empty($row["password"])) 
                    {
                        $sql="UPDATE mentees SET password = '$pass' WHERE roll = '$user'";
                        mysqli_query($conn,$sql);
                        mysqli_commit($conn);
                        echo '<script>alert("User added. You can login.")</script>';
                    }
                    else
                    {
                        echo "User already exists";
                    }
                }
                else
                {
                    echo "User doesn't exist";
                }
            }
        }
        else
        {
            echo "Passwords do not mactch";
        }
    }
    else
    {
        echo "Enter valid Username/Password";
    }
}
mysqli_close($conn);
?></div></form>
</body>
</html>

