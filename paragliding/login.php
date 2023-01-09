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
        <h1>Prijava</h1>
        <div id="signin">
        <?php if (!isset($_POST['_action_'])) { ?>
            <form action="" method="POST">
                <input type="hidden" id="_action_" name="_action_" value="TRUE">

                <label for="username">Korisničko ime*</label><br>
                <input type="text" id="username" name="username" required>
                <br>
                <label for="password">Lozinka*</label><br>
                <input type="password" id="password" name="password" required>
                <br>
                <input type="submit" value="Prijava">
            </form>
        <?php } else if ($_POST['_action_'] == TRUE) {
            $query  = "SELECT * FROM users";
            $query .= " WHERE username='" .  $_POST['username'] . "'";
            $result = @mysqli_query($dbConnection, $query);
            $row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
            if (password_verify($_POST['password'], $row['password'])) {
                $_SESSION['user']['valid'] = 'true';
                $_SESSION['user']['id'] = $row['id'];
                $_SESSION['user']['firstname'] = $row['firstname'];
                $_SESSION['user']['lastname'] = $row['lastname'];
                $_SESSION['message'] = '<p>Dobrodošli, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';
                header("Location: admin.php");
            } else {
                unset($_SESSION['user']);
                $_SESSION['message'] = '<p>Upisali ste krivi email ili lozinku!</p>';
                header("Location: login.php");
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