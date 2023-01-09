<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Paragliding Hrvatska</title>
        <?php include_once("header.html"); ?>
	</head>
    <body>
        <header>
            <div class="home-page-main">
                
                <h1 class="home-page-main-heading">Paragliding Hrvatska</h1>
                <div class="networks-links">
                    <a href="https://www.facebook.com" target="_blank">
                        <img src="images/facebook.svg" title="Linkedin" alt="Linkedin" style="width:2em; margin-top:0.4em"></a>
                    <a href="https://instagram.com" target="_blank">
                        <img src="images/instagram.svg" title="Twitter" alt="Twitter"style="width:2em; margin-top:0.4em"></a>
                    <a href="https://www.linkedin.com" target="_blank">
                        <img src="images/linkedin.svg" title="Linkedin" alt="Linkedin" style="width:2em; margin-top:0.4em"></a>
                    <a href="https://twitter.com" target="_blank">
                        <img src="images/twitter.svg" title="Twitter" alt="Twitter"style="width:2em; margin-top:0.4em"></a>
                </div>
            </div>
            <?php include_once("navigation.php"); ?>
        </header>

        <main>
            <figure>
                <img src="images/paragliding_01.png" alt="Paragliding iznad magle" title="Paragliding iznad magle">
                <figcaption>Paragliding iznad magle.</figcaption>
            </figure>
            <h1>Letite slobodno kao ptica</h1>
            <p>Biti slobodan poput ptice, postati prijatelj sa zračnim strujama i draškati vrhove oblaka ideje su stare koliko i čovjek. 
                Ljudi žele isprobati visine. Ljudi vole letjeti. Avionima, balonima, zmajevima… A što kada odluče spojiti padobranstvo i jedrenje? 
                Stiže paragliding.</p>
            <p>Ovaj relativno mlad sport koji u Hrvatskoj je pronašao savršenog partnera. Partnera za život. 
                Spektakularni krajolici oko Biokova i pogledi na Brač, Hvar ili Hercegovinu, kalnička poletišta koja predstavljaju 
                izazov i za najiskusnije, prijateljsko raspoloženi Tribalj u kojem će se i apsolutni početnik osjećati jako sigurno 
                te istarska Raspadalica gdje ćete moći gotovo dodirnuti vrhove Učke destinacije su koje su upisane u memoriju svakog ljubitelja paraglidinga.
            </p>
            <p>Visina i dužina leta ovise od vremenskih uvjeta, ali je moguće ostati u zraku nekoliko sati, popeti se nekoliko tisuća metara u visinu 
                i preletjeti nekoliko stotina kilometara. Svjetski rekord u preletu od jedne do druge točke preko 500km a visinski rekord je 
                preko 5000 metara. Padobran za jedrenje (Paraglajder) je letjelica kao i jedrilica, i isto kao zrakoplovno jedriličarstvo, 
                padobransko jedrenje koristi sile vjetrova i termika kako bi se ostalo u zraku i išlo što više i dalje. Kada su uvjeti optimalni 
                moguće je poletjeti s manjih brda, a da se na kraju dostigne visina od nekoliko tisuća metara. Sve je moguće u ovom športu i 
                granice se neprekidno pomiču. 
            </p>
        </main>
        
        <?php
            include_once("footer.php");
        ?>
    </body>
</html>