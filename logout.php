<?php
    session_start();
    session_unset();
    session_destroy();
    echo "<script>window.location='http://vchattogether.atwebpages.com';</script>";
?>