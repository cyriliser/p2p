<?php
    include_once("./global_functions.php");

    if (is_reloaded()) {
        echo "reloaded";
    } else {
        echo "not reloaded";
    }
    

?>