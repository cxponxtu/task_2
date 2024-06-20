<?php
function mentor($conn,$mentor) 
{   
    $sql = "SELECT cap,domain FROM mentors WHERE name = '$mentor'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0)
    { 
        $row = mysqli_fetch_assoc($result);
        $dom = $row["domain"];
        if($row["domain"] == "sys")
        {
            unset($row["domain"]);
            $row["domain"] = "SysAd";
        }
        if($row["domain"] == "web")
        {
            unset($row["domain"]);
            $row["domain"] = "WebDev";
        }
        if($row["domain"] == "app")
        {
            unset($row["domain"]);
            $row["domain"] = "AppDev";
        }
        echo "<h2 id=\"mentor_dom\">Domain : {$row["domain"]}</h2><h2>Allocated Mentees (Maximum Capacity : {$row["cap"]})</h2>";
    }

    $sql = "SELECT roll, name FROM mentees WHERE {$dom}men = '$mentor'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0)
    {
        echo "<form id=\"mentee\" action=\"home.php\" method=\"post\"><table><tr><th></th><th>Roll No.</th><th>Name</th></tr>";
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        for($i=0;$i<mysqli_num_rows($result);$i++)
        {
            echo "<tr><td><button class=\"table_button\" type=\"submit\" name=\"mentee\" value=\"{$row[$i]["roll"]}\">Select</button></td><td>{$row[$i]["roll"]}</td><td>{$row[$i]["name"]}</td></tr>";
        }
        echo "</table></form>";
    }
}