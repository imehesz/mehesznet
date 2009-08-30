<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div id="toplikebottom">
    <a href="/"><img src="images/storedbyu_100x39.png" alt="stored.by.u" title="stored.by.u" border="0" /></a>
    <?php /* <span style="width:100%;text-align:right;font-size:36px;font-weight:bolder;color:#ddd;">movies</span> */ ?>
</div>

<?php
    foreach( $movies as $movie ) : ?>
    <?php print_r( $movie ); ?>
    <br/><br/><br/><br/>
<?php endforeach; ?>