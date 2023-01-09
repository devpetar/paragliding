<!DOCTYPE html>
<html>
    <head>
        <title>Paragliding - Prijava</title>
        <?php include_once("header.html"); ?>
	</head>
    <body>
        <header>
            <?php include_once("navigation.php"); ?>
        </header>
        <main>
        <div id="news-container">
        <h1>Vijesti</h1>
        <?php 
            $query  = "SELECT * FROM news";
            $query .= " ORDER BY id DESC";
            $result = @mysqli_query($dbConnection, $query);
            $row = @mysqli_fetch_array($result);
            while($row = @mysqli_fetch_array($result)) {
                print '<div class="news">
                            <h2>'.$row['title'].'</h2>
                            <img src="images/'.$row['picture'].'"/>
                            <p style="font-size: 1em;">'.$row['description'].'</p>
                            <hr/>
                        </div>';
            }
        ?>
        </div>
        </main>
        
        <?php
            include_once("footer.php");
        ?>
    </body>
</html>
