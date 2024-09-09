<?php

session_start();
$db = mysqli_connect('localhost', 'root', '', 'sapsridb');

$district = "";
$dsdivision = "";
$gntype = "";
$cascadetype = "";
$fname = "";
$nic = "";
$benifit = "";
$dbid = 0;
$update = false;

if (isset($_POST['save'])) {
    $district = $_POST['district'];
    $dsdivision = $_POST['dsdivision'];
    $gntype = $_POST['gntype'];
    $cascadetype = $_POST['cascadetype'];
    $fname = $_POST['fname'];
    $nic = $_POST['nic'];
    $benifit = $_POST['benifit'];

    mysqli_query($db, "INSERT INTO csawdb (district, dsdivision, gntype, cascadetype, fname, nic, benifit) VALUES ('$district', '$dsdivision', '$gntype', '$cascadetype', '$fname', '$nic', '$benifit')");

    $_SESSION['message'] = "Data Saved Successfully!!";
    $_SESSION['msg_type'] = "success";
    header('location: CSADB.php');
}
if (isset($_POST['update'])) {
    $dbid = $_POST['dbid'];
    $district = $_POST['district'];
    $dsdivision = $_POST['dsdivision'];
    $gntype = $_POST['gntype'];
    $cascadetype = $_POST['cascadetype'];
    $fname = $_POST['fname'];
    $nic = $_POST['nic'];
    $benifit = $_POST['benifit'];

    mysqli_query($db, "UPDATE csawdb SET district='$district', dsdivision='$dsdivision', gntype='$gntype', cascadetype='$cascadetype', fname='$fname', nic='$nic', benifit='$benifit' WHERE dbid=$dbid");

    $_SESSION['message'] = "Data Updated Successfully!!";
    $_SESSION['msg_type'] = "warning";
    header('location: CSADB.php');
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM csawdb WHERE dbid=$id");

    $_SESSION['message'] = "Data Deleted Successfully!!";
    $_SESSION['msg_type'] = "danger";
    header('location: CSADB.php');
}


?>