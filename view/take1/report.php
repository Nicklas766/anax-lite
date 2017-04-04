<?php
?><h1>Report</h1>
<p>Redovisningstexter</p>

<section>
<h2>Kmom01</h2>
 <a href="http://www.student.bth.se/~nien16/dbwebb-kurser/oophp/me/kmom01/guess/">Länk till Guess</a>

 <h3> Hur känns det att hoppa rakt in i klasser med PHP, gick det bra? <h3>
<p>
    Precis klar med oopython-kursen, så det kändes som en naturlig transaktion. Men små saker som
    att istället för att använda punkt så använder man "->" för att ta fram saker från klassen.
</p>

<p>
    Kodstandarden "PSR-1" och "PSR-2" var lite strikt, i jämförelse med Python-kursen. Men det skapade en
    bra kodstruktur som är meningen, antar jag.
</p>

<p>
    Jag gjorde alla tärningsövningar, som hjälpte mig att förstå hur en PHP-klass ska/kan se ut. T.ex vilket tillfälle man
    bör använda publika eller privata properties. Metoderna kändes väldigt likt som i Python.
</p>

<p>
    Guess-uppgiften var väldigt stor och hyfsat svår, då det var ett tag sen jag gjorde PHP. Men den fräschade inte bara upp minnet
    om POST, GET, SESSION. Jag lärde mig många nya saker om dem. Jag skapade en egen GuessException, som "extendar" den vanliga, så
    om man stöter på GuessException så får man en "echo" som jag själv skapat.
</p>


 <h3> Berätta om dina reflektioner kring ramverk, anax-lite och din me-sida. <h3>

     <p>
        Att sätta ihop grunden var rätt så jobbigt, men när jag väl var klar så var det roligt att börja jobba med ramverket.
        Jag la mina vyer i "view/take1", där finns navbar.php och home.php osv. Med hjälp av min router så kunde jag se till så
        jag kan dela in koden i olika filer och visa dem hur jag vill på den routen. T.ex så har jag header.php och footer.php på alla
        mina routes, som ska visas.
     </p>

     <p>
        Jag började därefter att göra en design till sidan. Jag försökte skapa ett "ramverk" med CSS och divar. Om man går in i developer mode
        i webbläsaren så kan man se att jag delat in min sida likt anax-flat. Jag har t.ex en wrap-all och därefter site-header och main osv.
        Detta gjorde det lättare att bygga sidan och för att se till så koden ser bra ut, så har jag kommenterat väldigt bra enligt mig i mina .css filer.
        Däremot så är site-header utanför wrap-all just nu, då den är "fixed", något som ska fixas i framtiden. Utöver det så använder jag Cimage för att
        fixa mina bilder, t.ex i bylinen så har jag ett filter.
     </p>

     <p>
        I navbar.php så skapas navbaren med hjälp av den multidimensionella arrayen. Echo ser till så allt blir rätt i HTML-koden. If-sats med $app->request->getRoute() tittar om den
        matchar den URL:en som ska skapas med $app->url->create($inner["route"]), då får den klassen "current".
     </p>

<h3> Gick det bra att komma igång med MySQL, har du liknande erfarenheter sedan tidigare?<h3>

    <p>
        Vi har tidigare jobbat med MySQL. Personligen så har jag använt firefoxs plugin "MySQL Manager", den är smidig. Men jag har aldrig skrivit egen SQL-kod.
        Det var rätt så jobbigt att få igång Workbench, installera och skapa konto på Oracle. Men när man var klar, så kunde man börja koda. Gjorde fem delar av 15 som blir en tredjedel.
        Artikeln gav en bra introduktion på MySQL och det ska bli roligt att göra klart resten senare.
    </p>

</section>

<section>
<h2>Kmom02</h2>

<p>
    ...
</p>
</section>

<section>
<h2>Kmom03</h2>

<p>
    ...
</p>
</section>

<section>
<h2>Kmom04</h2>

<p>
    ...
</p>
</section>

<section>
<h2>Kmom05</h2>

<p>
    ...
</p>
</section>

<section>
<h2>Kmom06</h2>

<p>
    ...
</p>
</section>

<section>
<h2>Kmom07-10</h2>

<p>
    ...
</p>


</section>
