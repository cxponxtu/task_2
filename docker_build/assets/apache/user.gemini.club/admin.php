<?php
function admin($conn)
{ 
    echo "<h2>WebDev Mentors</h2>";
    $sql = "SELECT name FROM mentors WHERE domain = 'web'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        echo "<form class=\"mentor\" action=\"home.php\" method=\"post\"><table><tr><th></th><th>Name</th></tr>";
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        for($i=0;$i<mysqli_num_rows($result);$i++)
        {
                echo "<tr><td><button class=\"table_button\" type=\"submit\" name=\"navigate\" value=\"{$row[$i]["name"]}\">Select</button></td><td>{$row[$i]["name"]}</td></tr>";
        }
        echo "</table></form>";
    }

    echo "<h2>AppDev Mentors</h2>";
    $sql = "SELECT name FROM mentors WHERE domain = 'app'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        echo "<form class=\"mentor\" action=\"home.php\" method=\"post\"><table><tr><th></th><th>Name</th></tr>";
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        for($i=0;$i<mysqli_num_rows($result);$i++)
        {
                echo "<tr><td><button class=\"table_button\" type=\"submit\" name=\"navigate\" value=\"{$row[$i]["name"]}\">Select</button></td><td>{$row[$i]["name"]}</td></tr>";
        }
        echo "</table></form>";
    }

    echo "<h2>SysAd Mentors</h2>";
    $sql = "SELECT name FROM mentors WHERE domain = 'sys'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        echo "<form class=\"mentor\" action=\"home.php\" method=\"post\"><table><tr><th></th><th>Name</th></tr>";
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        for($i=0;$i<mysqli_num_rows($result);$i++)
        {
                echo "<tr><td><button class=\"table_button\" type=\"submit\" name=\"navigate\" value=\"{$row[$i]["name"]}\">Select</button></td><td>{$row[$i]["name"]}</td></tr>";
        }
        echo "</table></form>";
    }

    echo "<h2>Mentees</h2>";
    $sql = "SELECT roll, name FROM mentees";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        echo "<form id=\"mentee\" action=\"home.php\" method=\"post\"><table><tr><th></th><th>Roll No.</th><th>Name</th></tr>";
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        for($i=0;$i<mysqli_num_rows($result);$i++)
        {
                echo "<tr><td><button class=\"table_button\" type=\"submit\" name=\"navigate2\" value=\"{$row[$i]["roll"]}\">Select</button></td><td>{$row[$i]["roll"]}</td><td>{$row[$i]["name"]}</td></tr>";
        }
        echo "</table></form>";
    }
}