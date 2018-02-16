<?php
$conn = mysqli_connect("localhost", "root", "", "test");
 if (!$conn) {

 	die("conection failed : " .mysqli_connect_error());
 }?>