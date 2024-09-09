<?php

session_start();
$db = mysqli_connect('localhost', 'root', '', 'sapsridb');

$date = "";
$activity = "";
$componentno = "";
$activitytype = "";
$dsd = "";
$gnd = "";
$bmale = "";
$bfemale = "";
$btotal = "";
$dbid = 0;
$update = false;

if (isset($_POST['save'])) {
    $date = $_POST['date'];
    $activity = $_POST['activity'];
    $componentno = $_POST['componentno'];
    $activitytype = $_POST['activitytype'];
    $dsd = $_POST['dsd'];
    $gnd = $_POST['gnd'];
    $bmale = $_POST['bmale'];
    $bfemale = $_POST['bfemale'];
    $btotal = $_POST['btotal'];

    mysqli_query($db, "INSERT INTO bts (date, activity, componentno, activitytype, dsd, gnd, bmale, bfemale, btotal) VALUES ('$date', '$activity', '$componentno', '$activitytype', '$dsd', '$gnd', '$bmale', '$bfemale', '$btotal')");

    $_SESSION['message'] = "Data Saved Successfully!!";
    $_SESSION['msg_type'] = "success";
    header('location: bts.php');
}
if (isset($_POST['update'])) {
    $dbid = $_POST['dbid'];
    $date = $_POST['date'];
    $activity = $_POST['activity'];
    $componentno = $_POST['componentno'];
    $activitytype = $_POST['activitytype'];
    $dsd = $_POST['dsd'];
    $gnd = $_POST['gnd'];
    $bmale = $_POST['bmale'];
    $bfemale = $_POST['bfemale'];
    $btotal = $_POST['btotal'];

    mysqli_query($db, "UPDATE bts SET date='$date', activity='$activity', componentno='$componentno', dsd='$dsd', gnd='$gnd', bmale='$bmale', bfemale='$bfemale', btotal='$btotal' WHERE dbid=$dbid");

    $_SESSION['message'] = "Data Updated Successfully!!";
    $_SESSION['msg_type'] = "warning";
    header('location: bts.php');
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM bts WHERE dbid=$id");

    $_SESSION['message'] = "Data Deleted Successfully!!";
    $_SESSION['msg_type'] = "danger";
    header('location: bts.php');
}


?>