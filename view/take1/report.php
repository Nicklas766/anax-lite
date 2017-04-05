<div class="main">

<article>
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

 <h3>Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?<h3>

<p>
    Jag tycker att det känns helt okej att skriva koden. I början av kursmomentet så tyckte jag att det var svårt att hänga med i svängarna, men det släppte till slut.
    En fördel med att jobba inuti ramverket är att koden kan "startas" i vyerna t.ex. Ett bra exempel skulle vara mitt "Session" objekt, den startas i index.php och
    låter mig starta sessionen och sätta variabler till sessionen i vilka vyer jag vill.
</p>

<p>
    Men på tal om vyer, så försöker jag hålla dem så "dumma" som möjligt. Med andra ord, så försöker jag undvika logik så mycket det går. Jag vill alltså endast "redovisa"
    informationen i vyerna, inte skapa. Jag kommer gå in mer på detta på kalenderuppgiften, som jag tycker jag löste på ett bra sätt. I min router så skickar jag t.ex in en variabel
    om innehåller URL:en för redirecten, inte för komplext, mest som en övning för mig själv. Så en nackdel att skriva för mycket utanför ramverket blir att allt blir huller om buller.
</p>

<p>
    Jag gillar verkligen min lösning till navbar-uppgiften. I config/navbar.php så har jag en array med olika menyer. I mitt navbar-objekt så har jag "getHTML()" som med hjälp av interfaces, traits och
    konfigurationsfilen kan skapa menyer riktigt snabbt i mina vyer. Med en getHTML(1) så har jag min Session.php meny, på en rad kod i vy:n, utan massa logik.
</p>


<p>
    Jag börjar förstå hur allt hänger ihop lite mer. Men jag är fortfarande inte helt hundra vad "ramverket" är, hur bör man tänka? Det är defintivt något jag måste titta igenom, för
    att kunna få en bra struktur. Nästa steg för mig, är att göra mina vyer strukturerad på ett smart sätt med CSS:en, så jag får frihet och kan göra nya vyer snabbt.
</p>

 <h3>Hur väljer du att organisera dina vyer?<h3>

     <p>
         Toppen, då kan jag fortsätta skriva det jag började lite om i förra frågan. Så jag har en view/ katalog, inuti den så har jag navbar2/, session/ och take1/. I första katalogen, så ligger givetvis
         navbaren, som fungerar på samma sätt som jag skrev ovan. Vilken ordning av vyerna som ska visas bestäms i routern. I session/ så ligger alla vyer för alla session routes, för uppgiften.
     </p>

     <p>
         Därefter så ligger "header.php", "footer.php" och alla andra vyer i take1/. Jag kommer separera alla "baser" som "header.php" i en egen katalog, så jag kan separera "huvudstylen" från nya vyer, som
         t.ex "report.php". Jag använder mig alltså av HTML-kod för att strukturera hela hemsidan, i vyerna. För "calendar.php" och "session.php" så behövs däremot lite PHP-kod för att lösa uppgifterna, men minimalt.
     </p>

 <h3>Berätta om hur du löste integreringen av klassen Session.<h3>

     <p>
        Jag började med att inuti klassen lägga "src/Session/Session.php", därefter la jag till "namespace nicklas\Session;". Därefter skapar jag den i index.php och gör den en del av $app. Sedan så kan den användas i vyerna,
        då jag redan hade injectat $app i vyerna med, "$app->view->setApp($app)". Då har jag alltså tillgång till "$app->session-start()" t.ex och kan använda den för att jobba med sessionen.
     </p>

 <h3>Berätta om hur du löste uppgiften med Tärningsspelet 100/Månadskalendern, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?<h3>

     <p>
        Jag valde att göra månadskalendern. Idén var att undvika logiken så mycket som möjligt i "vyn", min klass "Calendar" ska sköta allt detta. Men hur undviker jag massor av submits och GETS hit och dit? Jo, jag kombinerar min
        "Session" klass med mitt "Calendar" objekt.
     </p>

     <p>
         Inuti klassen "Calendar" så har jag funktionen "showCal()", denna visar hela kalendern med massor av "echos". Men den är faktiskt smartare än så, då den kallar sina egna funktioner för att strukturera dagarna. Vi börjar med att
         göra en div som heter "calendar-container", den får cirka width 700px. Sedan inuti denna div så börjar vi kalla objektets metoder. Varje dag en egen div som har width 100px, varför just 100px?
         Jo för att då får vi ju 7 divar på en rad, som betyder att det blir som en riktigt kalender. Sedan har jag funktioner som är skapta för att med hjälp av width, kalkylera om nya gråa divar behövs skapas för att se till så kalendern blir jämn och
         fin.
     </p>

     <p>
         Objektet initeras med aktuella datumet. Privata variabler som innehåller information om datumet hjälper funktionerna att fungera. Då vi har objektet i en session, så kan jag med submits använda metoder i "Calendar" som "nextMonth()" och
         "previousMonth()", sidan laddas om med den nya månaden.
     </p>

     <p>
         Kortfattat så används två objekt, "Session" och "Calendar". Vyn "Calendar.php" fungerar som "spelplanen", båda klassernas metoder kallas och ser till så allt fungerar. Sedan så har också jag gjort en cool CSS-effekt, "scale" av dagarna kanske blev för mycket.
         Session-uppgiften och kalendern använder samma session, så bli gärna inte förvånad eller tro att "/dump" är felaktig, då det är meningen. Utöver det så var det en rolig uppgift
     </p>

      <h3>Några tankar kring SQL så här långt?<h3>

          <p>
              Inte så många tankar just nu. Det är ett intressant språk, känns lite annorlunda ut än andra vi gjort. Men det är nog för det handlar om tabeller och en databas man arbetar mot. Gjort 10 av 15 nu, sista tredjedel görs alltså i kmom03 som jag förstår det.
              Jag hoppas att vi får använda några kunskaper för att göra en databas för me-sidan/anax-lite.
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
