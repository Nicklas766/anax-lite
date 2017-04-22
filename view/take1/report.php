<div class="main">

<article>
    <?php
?>
<h1>Report</h1>
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

<h3>Hur kändes det att jobba med PHP PDO, SQL och MySQL?<h3>

<p>
    Kort sagt så kändes det bra, det kändes bra för att de fungerade riktigt bra tillsammans. PHP är grunden kan man nog säga, den är hjärnan bakom allt. Därefter har vi en MySQL databas som vi kopplar oss upp mot med PDO. MySQL databasen sätter jag upp
    med hjälp av SQL-kod för att få tabellen "users" att se ut som jag vill. Kopplingen mellan MySQL databasen har jag sparad i min "connect-klass", där kan jag skicka in SQL-kod och "fetcha" det jag behöver. PHP-koden leder vägen från start till slutet,
    den kontrollerar så "submits:en" är korrekta och att de kommer rätt.
</p>

<p>
    Jag känner att jag fick ett bra flöde på det hela och förstod tillslut hur det hör ihop. Så det känns bra.
</p>

<h3>Reflektera kring koden du skrev för att lösa uppgifterna, klasser, formulär, integration Anax Lite?<h3>

<p>
    Första uppgiften handlade om inloggning. Jag började med att skapa min MySQL databas genom att koppla upp mig mot BTH med SSH. Därefter så integrerade jag "connect-klassen", i Anax-Lite, som vi fått i andra övningen. Med hjälp av klassen så kunde jag koppla
    upp mig mot databasen. Därefter behövde jag PHP-kod och "forms" för "GET" och "POST", så jag skapade de vyer som behövdes. Helt ärligt, så är vyerna väldigt lika om inte identiska till övningen. Jag har försökt strukturera vyerna på bra ställen och göra det
    anpassad till min egna miljö dock. Jag har lagt till nya vyer för "edit" och nya funktioner i "connect-klassen" för att kunna hämta information från databasen. Profil vyn så hämtar jag information från databasen och redovisar för användaren, jag sätter även
    en liten cookie där.
</p>

<p>
    Andra uppgiften handlade om ett Admin gränssnitt. Jag gillade uppgiften då den kändes logiskt, då man i t.ex ett företag kanske har ett system för sina anställda, så vill man att en "icke-webprogrammerare" ska kunna hantera det. Hursomhelst så började jag med
    att skapa en ny klass, "Admin". Men att koppla upp mig mot databasen två gånger kändes onödigt, så "Admin" är en subklass av "Connect", jag har därav tillgång till databasen. Jag "echo:ar" ut HTML-kod från tre funktioner som behöver "current route", så
    jag injectade $app rakt in i "Admin-klassen", underbart, nu har min Admin-klass tillgång till $app och även till databasen.
</p>

<p>
    Angående just Admin-klassen, så satt jag och funderade, hur ska jag göra klassen kort men kraftfull? Att göra massor av HTML echo funktioner, var inte ett alternativ. Istället gjorde jag så att jag har massor av små funktioner, som hämtar informationen från
    databasen. Därefter sparar jag den i variabeln "$res" och skickar in den i en HTML echo funktion. T.ex så använder searchUser(), setAllTables() samma funktion, riktigt smidigt! Kunde säkert tryckt ner koden ännu mer och gjort det bättre, det kan man ju oftast göra.
</p>

<p>
    Som man märker så är min Admin-klass, smidig, då jag kan hålla min vyer "dumma", så jag hämtar mesta delen av koden från Admin-klassen. Användarna har behörighet, som är "ingenting", "user" och "admin". När man loggar in på en profil, så syns endast "edit profile" om
    man är en vanlig användare. Men om man har behörigheten "admin" så kommer man även se en länk till "Admin Tools" på sin profil-sida. Admin tools försökte jag göra smidig att använda med CSS-stil och bra placerade divar. Lösenordet är inte dolt när admin skriver, som var
    ett krav i förra uppgiften, för att det kändes logiskt (och var inte ett krav för uppgift 2). När man söker på en användare så är den strikt, man måste skriva användarnamnet korrekt, det går med wildcard dock.
</p>

<p>
    Om man tänker tillbaka på uppgifterna, vad hade jag kunnat gjort bättre? Vad kan jag göra bättre? Det första jag hade gjort är att skapa en "user-klass" som är inriktad på profilsidan och hanteringen av "den vanliga inloggningen", det hade sparat mycket kod i vyerna.
    Jag hade även velat skapa en config-fil med funktioner som kan användas både i klasserna som vyerna.
</p>

<h3>Känner du dig hemma i ramverket, dess komponenter och struktur?<h3>

<p>
    Efter kursmoment två så känns det som att jag har bättre koll. Jag vet hur jag ska få en klass att fungera i en vy, jag vet hur jag ska få tillgång till $app på vissa ställen. Jag försöker göra det till mitt egna som man blir uppmanad att göra. T.ex strukturen av
    hur man löste uppgifterna, eller vyerna. Men det känns som det finns några riktigt gömda juveler att hämta från ramverket fortfarande (att jag alltså inte är medveten om vissa saker som går att göra).
</p>

<h3>Hur bedömmer du svårighetsgraden på kursens inledande kursmoment, känner du att du lär dig något/bra saker?<h3>

<p>
    Om man börjar med svårighetsgraden, så tycker jag att det inte har varit alltför svårt. Det har defintivt varit utmanande och man har behövt tänka mer och reflektera. Första kursmomentet var verkligen inte en mjuk start som t.ex att endast göra en me-sida. Det
    var verkligen rakt på sak direkt. Men det var faktiskt skönt, att få hoppa rakt in i PHP igen, det var tufft däremot då jag inte hade kodat PHP på ett tag. Men rakt på sak i första momentet var nog bra, så man kommer igång, jag går ju kursen för att jag vill lära mig.
</p>
<p>
    Kort genomgång om vad jag lärt mig på dessa kursmomenten. Jag vet grunden hur en PHP-klass kan se ut, hur den kan användas. Jag vet hur jag kopplar upp mig mot en databas och hur jag pratar med den med SQL. Sen givetvis mycket andra saker, men det var nog det viktigaste.
    Det har varit mycket att göra och det tog mycket energi, men jag har ju lärt mig riktigt mycket, så det är värt det enligt mig. Men 6 kursmoment av denna takten kan nog bli för mycket, men för min del, så är det dags att börja med kmom04 nu.
</p>

</section>

<section>
<h2>Kmom04</h2>

<h2> Finns något att säga kring din klass för texfilter, eller rent allmänt om formattering och filtrering av text som sparas i databasen av användaren? </h2>
<p>
    För textfilter klassen så har jag valt att återanvända det som behövdes för att lösa kraven. Jag återanvände kod från "mos/ctextfilter" och tog från artiklarna. Jag valde även att lägga in ett default filter på klassen.
    Så om man inte anger ett filter vid skapningen, så kommer markdown användas som default, istället för att sidan inte visas. Däremot så filtreras inte texten förrän den ska visas på sidan, i databasen så sparas den utan
    filtrering.
</p>

<p>
    Mer än det så finns det nog inte så mycket mer att tillägga. Utöver textfilter, så valde jag att lägga in "esc()" funktionen i min functions.php, så jag har tillgång till den överallt.
</p>


<h2> Berätta hur du tänkte när du strukturerade klasserna och databasen för webbsidor och bloggposter? </h2>
<p>
    Jag har valt att skapa klasser för varje "post/page/block" och hanteringen av "content". Om vi börjar med admin-delen, så har jag lagt till "create", "overview" och "edit" som vyer.
    Där använder jag klassen "Content". Content klassen är en subklass av "Connect", den har funktioner för att se om en slug existerar eller en path. Den innehåller massor av olika funktioner för
    att kunna utföra "SQL statements", som skapar eller hämtar information. Den tar även fram HTML-kod för tabellen och submit-formen. Sedan har jag vyer som är "spelplanen" jag använder klassens funktioner
    och har if-satser för "GET" och "POST" (som använder funktioner i functions.php för att fungera).
</p>

<p>
    Därefter så har vi "page". Den har även en egen klass, som fungerar som Content-klassen, fast specifikt för "page". Pages.php är vyn för att man ska kunna se en tabell med information om sidorna, är de
    publicerade eller inte? Där finns en länk som leder användaren till page.php, där hämtas informationen med "SQL statements" från Page-klassen. Därefter ska man kunna se sidan.
</p>

<p>
    Angående "block" så valde jag att visa den på förstasidan. Block:sen visas som widgets längst ner, idén är en klassisk "titta här, läs mer". I "blocks.php" redovisas informationen, som använder klassen "Block".
    Den har även en länk för att man ska kunna se självaste texten. Det kändes onödigt att skapa en ny sida, så jag återanvände "page.php" för blocks också. Det gjorde jag med att lägga till
    "OR path = "$path" AND type = "block" AND (deleted IS NULL OR deleted > NOW()) AND published <= NOW();" i Page-klassen.
</p>

<p>
    Nu till bloggen. Bloggen känner jag att jag löste bäst av de tre typerna. För att få slug att fungera, så behövde jag börja med att fixa routern. Jag la till blog/**, detta gjorde så att slugs kunde användas.
    I vyn blog.php, så tittar den först "är det en slug?", om det är det, visa blogposten. Om det inte är en slug, visa alla blogginlägg. Min vy blir stilren och Blog-klassen sköter resten.
</p>

<h2> Förklara vilka routes som används för att demonstrera funktionaliteten för webbsidor och blogg (så att en utomstående kan testa). </h2>
<p>
    Det första man behöver/bör göra är att logga in som admin. Det kan man göra genom att trycka på "login" därefter skriver man, "admin" och "admin", sedan går man in på "admin-tools".
    Det finns två nya "create" och "overview", man trycker på "create" och skriver sedan en titel. Därefter kan man redigera den som man vill. För att se en tabell över allt innehåll så
    trycker man på "overview".
</p>

<p>
    För att se sidorna så går man in på "pages" som finns på menyn i headern. Där finns tabellen med information om man kan gå in på dem eller inte. Man trycker på titeln, därefter är man på sidan.
</p>

<p>
    Sedan för att se blogginlägg så trycker man på "blog", den finns också i menyn. Där ser man om den är raderad eller publicerad, om inget datum är angett för "published" så är den inte publicerad än.
    Sedan trycker man på den understrukna titeln för att se blogginlägget.
</p>

<p>
    Typen "block" som man skapar i admin-tools kommer att visas på förstasidan (längst ner). Man behöver ange en path om man vill kunna få översikten från texten då den använder en del av page-funktionen.
</p>
<h2> Hur känns det att dokumentera databasen så här i efterhand? </h2>
<p>
    Om med dokumentera menas med att vi gör en ER-modell, så känns det bra. För att i slutändan så kommer databasen bli stor, då kan det vara bra att ha något man kan kika på. Tänker på klassdiagrammet som vi
    använde i oopython-kursen. Det blev mycket lättare att skapa nya klasser då man kunde se hur allt hängde ihop.
</p>

<p>
    Om det menas med att vi skriver texter som lagras i databasen, så tycker jag det är strålande. För att man vill ju att en "icke-webbprogrammerare" ska kunna använda hemsidan, då är ju min admin-tools perfekt
    och ger frihet till denna personen.
</p>

<h2> Om du är självkritisk till koden du skriver i Anax Lite, ser du förbättringspotential och möjligheter till alternativ struktur av din kod? </h2>
<p>
    Jag ser många, många möjligheter. Det första jag vill/ska fixa är routern, just nu är min router som en soptipp om jag skulle dra en rolig metafor. Jag har praktiskt taget slängt in routerna. Jag såg
    Kenneths genomgång och han hade en otroligt bra lösning på detta, en funktion i App-klassen. Den ska jag implementera i mitt anax-lite.
</p>

<p>
    Därefter så skulle jag vilja städa mina vyer. Mitt mål skulle vara att alla vyerna fungerade lika bra som min admin/content/blog.php gör.
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
