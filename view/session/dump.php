
<div class="main">

<article>
    <p> Dump </p>

 <a href="<?= $redirect ?>">Back to sessionhandler</a>
<?php
// Starta sessionen
$app->session->start();
?>
<div style="background-color:white;">
<pre> <?= $app->session->dump(); ?></pre>
</div>
