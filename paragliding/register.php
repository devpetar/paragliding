<!DOCTYPE html>
<html>
    <head>
        <title>Paragliding - Registracija</title>
        <?php include_once("header.html"); ?>
	</head>
    <body>
        <header>
            <?php include_once("navigation.php"); ?>
        </header>
        <main>
        <h1>Registracija</h1>
        <div id="register">
            <?php if (!isset($_POST['_action_'])) { ?>
                <form action="" id="registration_form" name="registration_form" method="POST">
                    <input type="hidden" id="_action_" name="_action_" value="TRUE">

                    <br>
                    <label for="fname">Ime*</label><br>
                    <input type="text" id="fname" name="firstname" placeholder="Ime" required>
                    <br>
                    <label for="lname">Prezime*</label><br>
                    <input type="text" id="lname" name="lastname" placeholder="Prezime" required>
                    <br> 
                    <label for="email">E-mail*</label><br>
                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                    <br>
                    <label for="username">Korisničko ime*</label><br>
                    <input type="text" id="username" name="username" placeholder="Korisničko ime" required>
                    <br>
                    <label for="password">Lozinka*</label><br>
                    <input type="password" id="password" name="password" placeholder="Lozinka" required>
                    <br>
                    <label for="country">Zemlja</label><br>
                    <select name="country" id="country">
                        <option value="">Odaberite</option>
                        <option value="BH">Bosna i Hercegovina</option>
                        <option value="HR" selected>Hrvatska</option>
                        <option value="HU">Mađarska</option>
                        <option value="SL">Slovenija</option>
                    </select>
                    <br>
                    <input type="submit" value="Submit">
                </form>
            <?php
                } else if ($_POST['_action_'] == TRUE) {
                    $query  = "SELECT * FROM users";
                    $query .= " WHERE email='" .  $_POST['email'] . "'";
                    $query .= " OR username='" .  $_POST['username'] . "'";
                    $result = @mysqli_query($dbConnection, $query);
                    $row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    if (!isset($row['email']) && !isset($row['username'])) {
                        $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        
                        $query  = "INSERT INTO users (firstname, lastname, email, username, password, country)";
                        $query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" 
                                    . $_POST['username'] . "', '" . $pass_hash . "', '" . $_POST['country'] . "')";
                        $result = @mysqli_query($dbConnection, $query);
                        
                        # ucfirst() — Make a string's first character uppercase
                        # strtolower() - Make a string lowercase
                        echo '<p>' . ucfirst(strtolower($_POST['firstname'])) . ' ' .  ucfirst(strtolower($_POST['lastname'])) . ', hvala na registraciji!</p>
                        <hr>';
                    } else {
                        echo '<p>Korisnik s upisanim korisničkim imenom i/ili e-mailom već postoji!</p>';
                    }
                }
            ?>
        </div>
        </main>
        
        <?php
            include_once("footer.php");
        ?>
    </body>
</html>