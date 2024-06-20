<header>
    <form action="home.php" method="post" id="head">
        <div id="left">Gemini Club Inductions</div>
        <div id="right">
            <?php
                echo "<font id=\"username\">{$_SESSION["name"]} &nbsp&nbspDesignation : {$_SESSION["des"]}</font>";
                if (!empty($_POST["nav"]))
                {
                    if($_POST["nav"] == "Home")
                    {
                        header("Location: home.php");
                    }
                    else if($_POST["nav"] == "Log Out")
                    {
                        session_unset();
                        $_SESSION["status"]=2;
                        header("Location: index.php");
                    } 
                }        
            ?>
            <input class="header_button" type="submit" name="nav" value="Home">
            <input class="header_button" type="submit" name="nav" value="Log Out">
            </div>      
     </form>
</header>