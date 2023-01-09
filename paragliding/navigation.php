<?php 
	include_once("db.php");
?>

<nav>
	<ul>
		<li><a href="index.php">Početna stranica</a></li>
		<li><a href="news.php">Vijesti</a></li>
		<li><a href="gallery.php">Galerija</a></li>
		<li><a href="about_us.php">O nama</a></li>
		<li><a href="contact.php">Kontakt</a></li>
		
		<?php
			if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
		?>
			<li><a href="register.php">Registracija</a></li>
			<li><a href="login.php">Prijava</a></li>
		<?php
			} else if (isset($_SESSION['user']['valid']) && $_SESSION['user']['valid'] == 'true') {
		?>
			<li><a href="admin.php">Admin</a></li>
			<li><a href="logout.php">Odjava</a></li>';
		<?php
			}
		?>
	</ul>
</nav>