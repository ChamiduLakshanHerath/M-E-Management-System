<?php

session_start();
$db = mysqli_connect('localhost', 'root', '', 'sapsridb');

$district = "";
$dsdivision = "";
$gntype = "";
$name = "";
$benefit = "";
$dbid = 0;
$update = false;

if (isset($_POST['save'])) {
    $district = $_POST['district'];
    $dsdivision = $_POST['dsdivision'];
    $gntype = $_POST['gntype'];
    $name = $_POST['name'];
    $benefit = $_POST['benefit'];

    mysqli_query($db, "INSERT INTO sdwdb (district, dsdivision, gntype, name, benefit) VALUES ('$district', '$dsdivision', '$gntype', '$name', '$benefit')");

    $_SESSION['message'] = "Data Saved Successfully!!";
    $_SESSION['msg_type'] = "success";
    header('location: SDWDB.php');
}
if (isset($_POST['update'])) {
    $dbid = $_POST['dbid'];
    $district = $_POST['district'];
    $dsdivision = $_POST['dsdivision'];
    $gntype = $_POST['gntype'];
    $name = $_POST['name'];
    $benefit = $_POST['benefit'];

    mysqli_query($db, "UPDATE sdwdb SET district='$district', dsdivision='$dsdivision', gntype='$gntype', name='$name', benefit='$benefit' WHERE dbid=$dbid");

    $_SESSION['message'] = "Data Updated Successfully!!";
    $_SESSION['msg_type'] = "warning";
    header('location: SDWDB.php');
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM sdwdb WHERE dbid=$id");

    $_SESSION['message'] = "Data Deleted Successfully!!";
    $_SESSION['msg_type'] = "danger";
    header('location: SDWDB.php');
}


?>