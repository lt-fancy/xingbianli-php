<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2017/10/11
 * Time: 13:50
 */
session_start();
session_destroy();
echo "<script>parent.location.href='login.php';</script>";