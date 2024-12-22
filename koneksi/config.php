<?php

$conn = mysqli_connect("localhost", "root", "", "itc_dotolist");

if (!$conn) die("Gagal terhubung database") . mysqli_connect_error($conn);
