<?php

session_start();
$db = mysqli_connect('localhost', 'root', '', 'sapsridb');

$activitynumber = "";
$mainactivity = "";
$plannedbudget = "";
$teutn = "";
$status = "";
$awpid = 0;
$update = false;

if (isset($_POST['save'])) {
    $activitynumber = $_POST['activitynumber'];
    $mainactivity = $_POST['mainactivity'];
    $plannedbudget = $_POST['plannedbudget'];
    $teutn = $_POST['teutn'];
    $status = $_POST['status'];

    mysqli_query($db, "INSERT INTO dmawp (activitynumber, mainactivity, plannedbudget, teutn, status) VALUES ('$activitynumber', '$mainactivity', '$plannedbudget', '$teutn', '$status')");

    $_SESSION['message'] = "Data Saved Successfully!!";
    $_SESSION['msg_type'] = "success";
    header('location: DMAWPA.php');
}
if (isset($_POST['update'])) {
    $awpid = $_POST['awpid'];
    $activitynumber = $_POST['activitynumber'];
    $mainactivity = $_POST['mainactivity'];
    $plannedbudget = $_POST['plannedbudget'];
    $teutn = $_POST['teutn'];
    $status = $_POST['status'];

    mysqli_query($db, "UPDATE dmawp SET activitynumber='$activitynumber', mainactivity='$mainactivity', plannedbudget='$plannedbudget', teutn='$teutn', status='$status' WHERE awpid=$awpid");

    $_SESSION['message'] = "Data Updated Successfully!!";
    $_SESSION['msg_type'] = "warning";
    header('location: DMAWPA.php');
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM dmawp WHERE awpid=$id");

    $_SESSION['message'] = "Data Deleted Successfully!!";
    $_SESSION['msg_type'] = "danger";
    header('location: DMAWPA.php');
}


?>

