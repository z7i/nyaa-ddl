<?php
    if(isset($_POST['submit'])) {
    $f = $_post['f'];
    $c = $_post['c'];
    $q = $_post['q'];
    header ("location : /result/?f=$f&c=$c&q=$q")
    }
    ?>