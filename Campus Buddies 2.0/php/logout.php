<?php
    session_start();

    session_destroy();
    header("location: ../code/login.html")
?> 