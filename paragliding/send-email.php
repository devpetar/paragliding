<!DOCTYPE html>
<html>
    <head>
        <title>Paragliding - Mail poslan</title>
        <?php include_once("header.html"); ?>
	</head>
    <body>
        <header>
            <?php include_once("navigation.php"); ?>
        </header>
        <main>
        <h1>Mail poslan</h1>
		<div id="contact">
                <?php
				$EmailHeaders  = "MIME-Version: 1.0\r\n";
				$EmailHeaders .= "Content-type: text/html; charset=utf-8\r\n";
				$EmailHeaders .= "From: <pdeveric@vvg.hr>\r\n";
				$EmailHeaders .= "Reply-To:<pdeveric@vvg.hr>\r\n";
				$EmailHeaders .= "X-Mailer: PHP/".phpversion();
				$EmailSubject = "Kontakt forma";
				$EmailBody  = '
				<html>
				<head>
				   <title>'.$EmailSubject.'</title>
				   <style>
					body {
					  background-color: #ffffff;
						font-family: Arial, Helvetica, sans-serif;
						font-size: 16px;
						padding: 0px;
						margin: 0px auto;
						width: 500px;
						color: #000000;
					}
					p {
						font-size: 14px;
					}
					a {
						color: #00bad6;
						text-decoration: underline;
						font-size: 14px;
					}
					
				   </style>
				   </head>
				<body>
					<p>Ime: ' . $_POST['firstname'] . '</p>
					<p>Prezime: ' . $_POST['lastname'] . '</p>
					<p>E-mail: <a href="mailto:' . $_POST['email'] . '">' . $_POST['email'] . '</a></p>
					<p>Država: ' . $_POST['country'] . '</p>
					<p>Poruka: ' . $_POST['subject'] . '</p>
				</body>
				</html>';
				echo '<p>Ime: ' . $_POST['firstname'] . '</p>
				<p>Prezime: ' . $_POST['lastname'] . '</p>
				<p>E-mail: ' . $_POST['email'] . '</p>
				<p>Država: ' . $_POST['country'] . '</p>
				<p>Poruka: ' . $_POST['subject'] . '</p>';
				#mail($_POST['email'], $EmailSubject, $EmailBody, $EmailHeaders);

                echo '<p style="text-align:center; padding: 10px; background-color: #d7d6d6;border-radius: 5px;">Zaprimili smo vašu poruku!</p>';
			?>
		</div>
        </main>
        
        <?php
            include_once("footer.php");
        ?>
    </body>
</html>