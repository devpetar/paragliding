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
        <h1>Novosti</h1>
        <div id="news-container">
        <?php 
            $query  = "SELECT * FROM news";
            $query .= " ORDER BY id DESC";
            $result = @mysqli_query($dbConnection, $query);
            $row = @mysqli_fetch_array($result);
            print '<table><tbody>';
            while($row = @mysqli_fetch_array($result)) {
                print '
                <tr>
                    <td>' . $row['title'] . '</td>
                    <td>';
                    if(strlen($row['description']) > 160) {
                        echo substr(strip_tags($row['description']), 0, 160).'...';
                    } else {
                        echo strip_tags($row['description']);
                    }
                    print '
                    </td>
                </tr>';
            }
            print '</tbody></table>';
        ?>
        </div>
        </main>
        
        <?php
            include_once("footer.php");
        ?>
    </body>
</html>