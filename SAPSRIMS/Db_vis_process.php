<?php

session_start();
$db = mysqli_connect('localhost', 'root', '', 'sapsridb');

$district = "";
$dsdivision = "";
$gntype = "";
$cascadetype = "";
$tank = "";
$foname = "";
$fnumber = "";
$dbid = 0;
$update = false;

if (isset($_POST['save'])) {
    $district = $_POST['district'];
    $dsdivision = $_POST['dsdivision'];
    $gntype = $_POST['gntype'];
    $cascadetype = $_POST['cascadetype'];
    $tank = $_POST['tank'];
    $foname = $_POST['foname'];
    $fnumber = $_POST['fnumber'];

    mysqli_query($db, "INSERT INTO visdb (district, dsdivision, gntype, cascadetype, tank, foname, fnumber) VALUES ('$district', '$dsdivision', '$gntype', '$cascadetype', '$tank', '$foname', '$fnumber')");

    $_SESSION['message'] = "Data Saved Successfully!!";
    $_SESSION['msg_type'] = "success";
    header('location: VISDB.php');
}
if (isset($_POST['update'])) {
    $dbid = $_POST['dbid'];
    $district = $_POST['district'];
    $dsdivision = $_POST['dsdivision'];
    $gntype = $_POST['gntype'];
    $cascadetype = $_POST['cascadetype'];
    $tank = $_POST['tank'];
    $foname = $_POST['foname'];
    $fnumber = $_POST['fnumber'];

    mysqli_query($db, "UPDATE visdb SET district='$district', dsdivision='$dsdivision', gntype='$gntype', cascadetype='$cascadetype', tank='$tank', foname='$foname', fnumber='$fnumber' WHERE dbid=$dbid");

    $_SESSION['message'] = "Data Updated Successfully!!";
    $_SESSION['msg_type'] = "warning";
    header('location: VISDB.php');
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM visdb WHERE dbid=$id");

    $_SESSION['message'] = "Data Deleted Successfully!!";
    $_SESSION['msg_type'] = "danger";
    header('location: VISDB.php');
}


?>