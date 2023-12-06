<?php
session_start(); 
    if(!isset($_SESSION["depth"]))
    {
        $_SESSION["depth"] = 1;
    }
    else 
    { 
        $_SESSION["depth"]++;
    }
?>