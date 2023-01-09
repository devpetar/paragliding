<!DOCTYPE html>
<html>
    <head>
        <title>Paragliding - Kontakt</title>
        <?php include_once("header.html"); ?>
	</head>
    <body>
        <header>
            <?php include_once("navigation.php"); ?>
        </header>
        <main>
        <h1>Kontakt</h1>
            <div id="contact">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5563.906282243771!2d15.974554270505905!3d45.79216649414746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d666ce30a11d%3A0xe9294a78db8537e2!2sPARAJEDRILI%C4%8CARSKI%20KLUB%20ZAGREB!5e0!3m2!1sen!2shr!4v1673272788315!5m2!1sen!2shr" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                <form action="send-email.php" method="POST">
                    <br>
                    <label for="fname">Ime *</label><br>
                    <input type="text" id="fname" name="firstname" placeholder="Vaše ime" required>
                    <br>
                    <label for="lname">Prezime *</label><br>
                    <input type="text" id="lname" name="lastname" placeholder="Vaše prezime" required>
                    <br>
                    <label for="email">E-mail *</label><br>
                    <input type="email" id="email" name="email" placeholder="Vaš e-mail" required>
                    <br>
                    <label for="country">Zemlja</label><br>
                    <select id="country" name="country">
                        <option value="">Odaberite</option>
                        <option value="BH">Bosna i Hercegovina</option>
                        <option value="HR" selected>Hrvatska</option>
                        <option value="HU">Mađarska</option>
                        <option value="SL">Slovenija</option>
                    </select>
                    <br>
                    <label for="subject">Poruka</label><br>
                    <textarea id="subject" name="subject" placeholder="Tekst poruke" style="height:150px"></textarea>
                    <br>
                    <input type="submit" value="Pošalji">
                </form>
            </div>
        </main>
        
        <?php
            include_once("footer.php");
        ?>
    </body>
</html>