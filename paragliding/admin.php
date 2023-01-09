<!DOCTYPE html>
<html>
    <head>
        <title>Paragliding - Admin</title>
        <?php include_once("header.html"); ?>
	</head>
    <body>
        <header>
            <?php include_once("navigation.php"); ?>
        </header>
        <main>
        <?php
            if (isset($_POST['_action_']) && $_POST['_action_'] == 'add_news') {
                $_SESSION['message'] = '';
                $query  = "INSERT INTO news (title, description, archive)";
                $query .= " VALUES ('" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', '" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', '" . $_POST['archive'] . "')";
                $result = @mysqli_query($dbConnection, $query);
                
                $ID = mysqli_insert_id($dbConnection);
                
                if($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {
                        
                    $ext = strtolower(strrchr($_FILES['picture']['name'], "."));
                    
                    $_picture = $ID . '-' . rand(1,100) . $ext;
                    copy($_FILES['picture']['tmp_name'], "images/".$_picture);
                    
                    if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') {
                        $_query  = "UPDATE news SET picture='" . $_picture . "'";
                        $_query .= " WHERE id=" . $ID . " LIMIT 1";
                        $_result = @mysqli_query($dbConnection, $_query);
                        $_SESSION['message'] .= '<p>You successfully added picture.</p>';
                    }
                }
                
                
                $_SESSION['message'] .= '<p>Uspješno dodana vijest!</p>';
                
                header("Location: news.php");
            }
            
            # Editiraj vijest
            if (isset($_POST['_action_']) && $_POST['_action_'] == 'edit_news') {
                $query  = "UPDATE news SET title='" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', description='" . htmlspecialchars($_POST['description'], ENT_QUOTES) . "', archive='" . $_POST['archive'] . "'";
                $query .= " WHERE id=" . (int)$_POST['edit'];
                $query .= " LIMIT 1";
                $result = @mysqli_query($dbConnection, $query);
                
                # picture
                if($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {
                        
                    # strtolower - Returns string with all alphabetic characters converted to lowercase. 
                    # strrchr - Find the last occurrence of a character in a string
                    $ext = strtolower(strrchr($_FILES['picture']['name'], "."));
                    
                    $_picture = (int)$_POST['edit'] . '-' . rand(1,100) . $ext;
                    copy($_FILES['picture']['tmp_name'], "images/".$_picture);
                    
                    
                    if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif') { # test if format is picture
                        $_query  = "UPDATE news SET picture='" . $_picture . "'";
                        $_query .= " WHERE id=" . (int)$_POST['edit'] . " LIMIT 1";
                        $_result = @mysqli_query($dbConnection, $_query);
                        $_SESSION['message'] .= '<p>You successfully added picture.</p>';
                    }
                }
                
                $_SESSION['message'] = '<p>You successfully changed news!</p>';
                
                # Redirect
                header("Location: index.php?menu=7&action=2");
            }
            
            # Brisanje vijesti
            if (isset($_GET['delete']) && $_GET['delete'] != '') {
                
                # Delete picture
                $query  = "SELECT picture FROM news";
                $query .= " WHERE id=".(int)$_GET['delete']." LIMIT 1";
                $result = @mysqli_query($dbConnection, $query);
                $row = @mysqli_fetch_array($result);
                @unlink("images/".$row['picture']); 
                
                # Delete news
                $query  = "DELETE FROM news";
                $query .= " WHERE id=".(int)$_GET['delete'];
                $query .= " LIMIT 1";
                $result = @mysqli_query($dbConnection, $query);

                $_SESSION['message'] = '<p>You successfully deleted news!</p>';
                
                # Redirect
                header("Location: index.php?menu=7&action=2");
            }
         
            if (isset($_GET['id']) && $_GET['id'] != '') {
                $query  = "SELECT * FROM news";
                $query .= " WHERE id=".$_GET['id'];
                $query .= " ORDER BY id DESC";
                $result = @mysqli_query($dbConnection, $query);
                $row = @mysqli_fetch_array($result);
                print '
                <h2>Vijesti</h2>
                <div class="news">
                    <img src="images/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
                    <h2>' . $row['title'] . '</h2>
                    ' . $row['description'] . '
                    <hr>
                </div>';
            }
            
            #Add news 
            else if (isset($_GET['add']) && $_GET['add'] != '') {
                
                print '
                <h2>Dodaj vijest</h2>
                <form action="" id="news_form" name="news_form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="_action_" name="_action_" value="add_news">
                    
                    <label for="title">Title *</label>
                    <input type="text" id="title" name="title" placeholder="News title.." required>
                    <label for="description">Description *</label>
                    <textarea id="description" name="description" placeholder="News description.." required></textarea>
                        
                    <label for="picture">Picture</label>
                    <input type="file" id="picture" name="picture">
                                
                    <label for="archive">Archive:</label><br />
                    <input type="radio" name="archive" value="Y"> YES &nbsp;&nbsp;
                    <input type="radio" name="archive" value="N" checked> NO
                    
                    <hr>
                    
                    <input type="submit" value="Spremi">
                </form>';
            }
            #Edit news
            else if (isset($_GET['edit']) && $_GET['edit'] != '') {
                $query  = "SELECT * FROM news";
                $query .= " WHERE id=".$_GET['edit'];
                $result = @mysqli_query($dbConnection, $query);
                $row = @mysqli_fetch_array($result);
                $checked_archive = false;

                print '
                <h2>Ažuriraj vijest</h2>
                <form action="" id="news_form_edit" name="news_form_edit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="_action_" name="_action_" value="edit_news">
                    <input type="hidden" id="edit" name="edit" value="' . $row['id'] . '">
                    
                    <label for="title">Title *</label>
                    <input type="text" id="title" name="title" value="' . $row['title'] . '" placeholder="News title.." required>
                    <label for="description">Description *</label>
                    <textarea id="description" name="description" placeholder="News description.." required>' . $row['description'] . '</textarea>
                        
                    <label for="picture">Picture</label>
                    <input type="file" id="picture" name="picture">
                                
                    <label for="archive">Archive:</label><br />
                    <input type="radio" name="archive" value="Y"'; if($row['archive'] == 'Y') { echo ' checked="checked"'; $checked_archive = true; } echo ' /> YES &nbsp;&nbsp;
                    <input type="radio" name="archive" value="N"'; if($checked_archive == false) { echo ' checked="checked"'; } echo ' /> NO
                    
                    <hr>
                    
                    <input type="submit" value="Predaj">
                </form>';
            }
            else {
                print '
                <h2>Vijesti</h2>
                <div id="news">
                    <table>
                        <thead>
                            <tr>
                                <th width="16"></th>
                                <th width="16"></th>
                                <th width="16"></th>
                                <th>Naslov</th>
                                <th>Tekst</th>
                                <th width="16"></th>
                            </tr>
                        </thead>
                        <tbody>';
                        $query  = "SELECT * FROM news";
                        $query .= " ORDER BY id DESC";
                        $result = @mysqli_query($dbConnection, $query);
                        while($row = @mysqli_fetch_array($result)) {
                            print '
                            <tr>
                                <td><a href=""><img src="images/user.png" alt="user"></a></td>
                                <td><a href=""><img src="images/edit.png" alt="uredi"></a></td>
                                <td><a href=""><img src="images/delete.png" alt="obriši"></a></td>
                                <td>' . $row['title'] . '</td>
                                <td>';
                                if(strlen($row['description']) > 160) {
                                    echo substr(strip_tags($row['description']), 0, 160).'...';
                                } else {
                                    echo strip_tags($row['description']);
                                }
                                print '
                                </td>
                                <td>';
                                    if ($row['archive'] == 'Y') { print '<img src="images/inactive.png" alt="" title="" />'; }
                                    else if ($row['archive'] == 'N') { print '<img src="images/active.png" alt="" title="" />'; }
                                print '
                                </td>
                            </tr>';
                        }
                    print '
                        </tbody>
                    </table>
                </div>';
            }
            
            ?>

        </main>

        <?php
            include_once("footer.php");
        ?>
    </body>
</html>