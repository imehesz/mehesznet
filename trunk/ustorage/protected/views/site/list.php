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

<table id="box-table-a">
<thead>
    <tr>
        <th scope="col">Imdb ID</th>
        <th scope="col">title</th>
        <th scope="col">year</th>
        <th scope="col">last cached</th>
    </tr>
</thead>
<tbody>
     <?php foreach( $movies as $movie ) : ?>
        <tr alt="click for more info" title="click for more info" onclick="javascript:$('#info_<?=$movie->imdbID?>').show();
;">
            <td><?= $movie -> imdbID; ?></td>
            <td><?= $movie -> title; ?></td>
            <td><?= $movie -> year; ?></td>
            <td style="font-size:10px;"><?= date('\o\n l, F jS Y', $movie -> modified); ?></td>
        </tr>
        <tr class="nohover" id="info_<?=$movie->imdbID;?>" style="display:none;">
            <td></td>
            <td colspan="3" style="font-size:12px;">
                blah blah blah, yup yup yup <br />
                hey hey he<br>
                <a href="#">send email</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>