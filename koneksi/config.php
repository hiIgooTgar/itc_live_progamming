<?php

$conn = mysqli_connect("localhost", "root", "", "tic_dotolist");

if (!$conn) die("Gagal terhubung database") . mysqli_connect_error($conn);
