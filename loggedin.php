<?php
    session_start();

    if (isset($_SESSION["username"])) {
        if ($_SESSION["privilege"] == "user") {
            header('location: user/');
            exit();
        }
        if ($_SESSION["privilege"] == "admin") {
            header('location: admin/');
            exit();
        }
        if ($_SESSION["privilege"] == "student") {
            header('location: student/');
            exit();
        }
    }
    else {
        header('location: ./');
        exit();
    }
?>