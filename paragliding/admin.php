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
            
            # Obriši vijest
            if (isset($_GET['delete']) && $_GET['delete'] != '') {
                
                # Delete picture
                $query  = "SELECT picture FROM news";
                $query .= " WHERE id=".(int)$_GET['delete']." LIMIT 1";
                $result = @mysqli_query($MySQL, $query);
                $row = @mysqli_fetch_array($result);
                @unlink("images/".$row['picture']); 
                
                $query  = "DELETE FROM news";
                $query .= " WHERE id=".(int)$_GET['delete'];
                $query .= " LIMIT 1";
                $result = @mysqli_query($MySQL, $query);

                $_SESSION['message'] = '<p>Uspješno ste obrisali vijest!</p>';
                
                unset($_GET['delete']);
                header("Location: admin.php");
            }
            # Dodaj vijest 
            else if (isset($_GET['add']) && $_GET['add'] != '') { ?>
                
                <h2>Dodaj vijest</h2>
                <form action="" id="news_form" name="news_form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="_action_" name="_action_" value="add_news">
                    
                    <label for="title">Title *</label><br>
                    <input type="text" id="title" name="title" placeholder="News title.." required><br>

                    <label for="description">Description *</label><br>
                    <textarea id="description" name="description" placeholder="News description.." required></textarea><br>
                        
                    <label for="picture">Picture</label><br>
                    <input type="file" id="picture" name="picture"><br>
                                
                    <label for="archive">Arhiviraj:</label><br />
                    <input type="radio" name="archive" value="Y"> Da &nbsp;&nbsp;
                    <input type="radio" name="archive" value="N" checked> Ne
                    
                    <hr>
                    
                    <input type="submit" value="Spremi">
                </form>
            <?php }
            # Ažuriraj vijest
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
                    
                    <label for="title">Title *</label><br>
                    <input type="text" id="title" name="title" value="' . $row['title'] . '" placeholder="News title.." required><br>

                    <label for="description">Description *</label><br>
                    <textarea id="description" name="description" placeholder="News description.." required>' . $row['description'] . '</textarea><br>
                        
                    <label for="picture">Picture</label><br>
                    <input type="file" id="picture" name="picture"><br>
                                
                    <label for="archive">Arhiviraj:</label><br>
                    <input type="radio" name="archive" value="Y"'; if($row['archive'] == 'Y') { echo ' checked="checked"'; $checked_archive = true; } echo ' /> Da &nbsp;&nbsp;
                    <input type="radio" name="archive" value="N"'; if($checked_archive == false) { echo ' checked="checked"'; } echo ' /> Ne
                    
                    <hr>
                    
                    <input type="submit" value="Predaj">
                </form>';
            }
            else {
                print '
                <h2>Vijesti</h2>
                <div id="news">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th width="16"></th>
                                <th width="16"></th>
                                <th>Naslov</th>
                                <th>Tekst</th>
                                <th width="16">Aktivno</th>
                            </tr>
                        </thead>
                        <tbody>';
                        $query  = "SELECT * FROM news";
                        $query .= " ORDER BY id DESC";
                        $result = @mysqli_query($dbConnection, $query);
                        while($row = @mysqli_fetch_array($result)) {
                            print '
                            <tr>
                                <td><a href="admin.php?edit='.$row['id'].'"><img src="images/edit.png" alt="uredi"></a></td>
                                <td><a href="admin.php?delete='.$row['id'].'"><img src="images/delete.png" alt="obriši"></a></td>
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
