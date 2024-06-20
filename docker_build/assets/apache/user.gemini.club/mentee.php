<?php
function mentee($conn,$mentee)
{
    $sql = "SELECT web,app,sys FROM mentees WHERE roll = '$mentee'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)> 0)
    {
        $row = mysqli_fetch_assoc($result);
        foreach($row as $key => $value)
        {
            if($value == NULL)
            {
                unset($row[$key]);
            }
        }
        $row = array_flip($row);
        foreach($row as $key => $value)
        {
            if($key == -1)
            {
                $derg = 1;
            }
            if($value == "web")
            {
                $row[$key] = "WebDev";
            }
            else if($value == "app")
            {
                $row[$key] = "AppDev";
            }
            else if($value == "sys")
            {
                $row[$key] = "SysAd";
            }
        }
        echo "<h2>Registered Domains</h2>";
        for($i= 1; $i<=count($row); $i++)
        {   
            if(!empty($row[$i]))
            {
                echo "<p class=\"domain\">$row[$i]</p>";
            }
        }
        if (!empty($derg))
        {
            echo "<h2>Deregistered Domains</h2>";
            foreach($row as $key => $value)
            {
                if($key == -1)
                {
                    echo "<p class=\"domain\">$value</p>";
                }
            }
        }
    }

    $sql = "SELECT webmen,appmen,sysmen FROM mentees WHERE roll = '$mentee'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)> 0)
    {
        $row = mysqli_fetch_assoc($result);
        echo "<h2>Mentors</h2><table><tr><th>Domain</th><th>Mentor</th></tr>";
        foreach($row as $key => $value)
        {
            if($value == -1)
            {
                unset($row[$key]);
                $row[$key] = "<font color=\"#ff9900\">Not yet Alloted</font>";
            }
        }
        if($row["webmen"] != NULL)
        {
            echo "<tr>
            <td>WebDev</td><td>{$row["webmen"]}</td>
        </tr>";
        }
        if($row["appmen"] != NULL)
        {
            echo "<tr>
            <td>AppDev</td><td>{$row["appmen"]}</td>
        </tr>";
        }
        if($row["sysmen"] != NULL)
        {
            echo "<tr>
            <td>SysAd</td><td>{$row["sysmen"]}</td>
        </tr>";
        }
        echo "</table>";
    }

    $sql="SELECT * FROM task_submitted WHERE roll = '$mentee'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)> 0)
    {
        $row = mysqli_fetch_assoc($result);
        foreach($row as $key => $value)
        {
            if($value == 1)
            {
                unset($row[$key]);
                $row[$key] = "<font color=\"green\">Yes</font>";
            }
            if($value == 0 && $value != NULL)
            {
                unset($row[$key]);
                $row[$key] = "<font color=\"red\">No</font>";
            }
        }
        echo "<h2>Task Submitted</h2><table>
        <tr>
            <th>Domain</th>
            <th>Task 1</th>
            <th>Task 2</th>
            <th>Task 3</th>
        </tr>";
        if($row["web1"] != NULL)
        {
            echo "<tr>
            <td>WebDev</td>
            <td>{$row["web1"]}</td>
            <td>{$row["web2"]}</td>
            <td>{$row["web3"]}</td>
        </tr>";
        }
        if($row["app1"] != NULL)
        {
            echo "<tr>
            <td>AppDev</td>
            <td>{$row["app1"]}</td>
            <td>{$row["app2"]}</td>
            <td>{$row["app3"]}</td>
        </tr>";
        }
        if($row["sys1"] != NULL)
        {
            echo "<tr>
            <td>SysAd</td>
            <td>{$row["sys1"]}</td>
            <td>{$row["sys2"]}</td>
            <td>{$row["sys3"]}</td>
        </tr>";
        }
        echo "</table>";
    }

    $sql="SELECT * FROM task_completed WHERE roll = '$mentee'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)> 0)
    {
        $row = mysqli_fetch_assoc($result);
        foreach($row as $key => $value)
        {
            if($value == -1)
            {
                unset($row[$key]);
                $row[$key] = "<font color=\"#ff9900\">Not yet Checked</font>";
            }
            if($value == 1)
            {
                unset($row[$key]);
                $row[$key] = "<font color=\"green\">Yes</font>";
            }
            if($value == 0 && $value != NULL)
            {
                unset($row[$key]);
                $row[$key] = "<font color=\"red\">No</font>";
            }
        }
        echo "<h2>Task Completed</h2><table>
        <tr>
            <th>Domain</th>
            <th>Task 1</th>
            <th>Task 2</th>
            <th>Task 3</th>
        </tr>";
        if($row["web1"] != NULL)
        {
            echo "<tr>
            <td>WebDev</td>
            <td>{$row["web1"]}</td>
            <td>{$row["web2"]}</td>
            <td>{$row["web3"]}</td>
        </tr>";
        }
        if($row["app1"] != NULL)
        {
            echo "<tr>
            <td>AppDev</td>
            <td>{$row["app1"]}</td>
            <td>{$row["app2"]}</td>
            <td>{$row["app3"]}</td>
        </tr>";
        }
        if($row["sys1"] != NULL)
        {
            echo "<tr>
            <td>SysAd</td>
            <td>{$row["sys1"]}</td>
            <td>{$row["sys2"]}</td>
            <td>{$row["sys3"]}</td>
        </tr>";
        }
        echo "</table>";
    }
}