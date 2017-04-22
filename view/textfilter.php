<?php

// Text that will be tested
$textOrig = "[b]Bold text[/b] [i]Italic text[/i] [url=http://dbwebb.se]a link to dbwebb[/url]";

$textOrig2 = "http://dbwebb.se";
$textOrig3 = "Hello this is a sentence for linebreak.
I just made a line break,
and another one,
and another one";

$textOrig4 = "Header level 1 {#id1}
=====================

Here comes a paragraph.

* Unordered list
* Unordered list again
";

$textOrig5 = <<<EOD
Först lite vanlig text följt av en tom rad.

Då tar vi ett nytt stycke med lite bbcode med [b]bold[/b] och [i]italic[/i] samt en [url=https://dbwebb.se]länk till dbwebb[/url].

Sen testar vi en länk till https://dbwebb.se som skall bli klickbar.

Avslutningsvis blir det en [länk skriven i markdown](https://dbwebb.se) och länken leder till dbwebb.

Avsluter med en lista som formatteras till ul/li med markdown.

* Item 1
* Item 2

EOD;

// Array for filters and texts from testExample.php.
$textArray = [$textOrig, $textOrig2, $textOrig3, $textOrig4, $textOrig5];
$filterArray = ["bbcode", "link", "nl2br", "markdown", "bbcode,markdown,link"];

?>

<div class="main">

<h1>Developmode for Textfilter</h1>
<?php
// for loop to loop through $textArray and $filterArray values. For example divs
echo "<div class='flex-container'>";
$arr_length = count($filterArray);
for ($i=0; $i<$arr_length; $i++) {
    $filteredText = $app->textfilter->doFilter($textArray[$i], $filterArray[$i]);
    echo "<div class='container'><h1>Example " . $filterArray[$i] . "</h1>";
    echo "<h3> Without filter </h3><div class='text'>" . $textArray[$i] . "</div>";
    echo "<h3> With filter </h3><div class='text'>" . $filteredText . "</div></div>";
}
echo "</div>";
