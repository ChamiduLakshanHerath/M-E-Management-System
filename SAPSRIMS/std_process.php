<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection code
$db = mysqli_connect('localhost', 'root', '', 'sapsridb');

// Other processing code



$name = "";
$desiganationtype = "";
$componenttype = "";
$cno = "";
$email = "";
$password = "";
$sid = 0;
$update = false;

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $desiganationtype = $_POST['desiganationtype'];
    $componenttype = $_POST['componenttype'];
    $cno = $_POST['cno'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    mysqli_query($db, "INSERT INTO std (name, desiganationtype, componenttype, cno, email, password) VALUES ('$name', '$desiganationtype', '$componenttype', '$cno', '$email', '$password')");

    $_SESSION['message'] = "Data Saved Successfully!!";
    $_SESSION['msg_type'] = "success";
    header('location: staffdetails.php');
}
if (isset($_POST['update'])) {
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $desiganationtype = $_POST['desiganationtype'];
    $componenttype = $_POST['componenttype'];
    $cno = $_POST['cno'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    mysqli_query($db, "UPDATE std SET name='$name', desiganationtype='$desiganationtype', componenttype='$componenttype', cno='$cno', email='$email', password='$password' WHERE sid=$sid");

    $_SESSION['message'] = "Data Updated Successfully!!";
    $_SESSION['msg_type'] = "warning";
    header('location: staffdetails.php');
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM std WHERE sid=$id");

    $_SESSION['message'] = "Data Deleted Successfully!!";
    $_SESSION['msg_type'] = "danger";
    header('location: staffdetails.php');
}


?>