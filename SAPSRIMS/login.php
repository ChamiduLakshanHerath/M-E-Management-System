<?php
include('session.php');
include('std_process.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize input
    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);

    // Check user credentials
    $query = "SELECT * FROM std WHERE email='$email' AND password='$password'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the user's details
        $row = mysqli_fetch_assoc($result);
        $componentType = $row['componenttype'];
        $name = $row['name']; // Assuming column 'name' exists
        $email = $row['email']; // Assuming column 'email' exists
        $cno = $row['mobile']; // Assuming column 'mobile' exists
        $designationType = $row['designation']; // Assuming column 'designation' exists

        // Store user details in session
        session_start();
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['cno'] = $cno;
        $_SESSION['designation'] = $designationType;

        // Redirect based on component type
        switch ($componentType) {
            case "Coordinator":
                header("Location: adminpannel.php");
                break;
            case "Component 01 - CSA":
                header("Location: CSApannel.php");
                break;
            case "Component 01 - VIS":
                header("Location: VISpannel.php");
                break;
            case "Component 02":
                header("Location: SDWpannel.php");
                break;
            case "Component 03":
                header("Location: DMpannel.php");
                break;
            default:
                echo "Invalid component type.";
                break;
        }
        exit;
    } else {
        echo "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAPSRI MS: Sign in</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="loginbody">
    <nav class="navbar">
        <a class="navbar-brand" href="#">
            <img class="brand" src="img/SapsriLogo.png" alt="">
        </a>
        <h1 class="brandheading">Maintain & Evaluation System</h1>
    </nav>
    <div class="loginimg">
        <img class="login" src="img/WhiteLogo.png"> 
    </div>
    <div class="logintitle">
        <h5 class="title">Maintain & Evaluation</h5>
        <h5 class="subtitle">System</h5>
    </div>
    <form action="login.php" method="post">
        <div class="loginform-group">
            <div class="logincard">
                <div class="logincard-header">Login to SAPSRI</div><br>
                <div class="loginform-group">
                    <label>Email</label><br>
                    <input type="email" class="loginform-control" name="email" required><br>
                </div>
                <div class="loginform-group">
                    <label>Password</label><br>
                    <input type="password" class="loginform-control" name="password" required>
                </div><br>    
                <button type="submit" class="loginbtn">Sign in</button><br>
                <div class="text"><br>
                    <a class="small" href="register.php">Password Management</a><br>
                </div>
            </div>
        </div>
    </form>
    <footer class="copyright">
        <p>&copy; <?php echo date("Y"); ?> South Asia Partnership Sri Lanka. All rights reserved.</p>
    </footer>
</body>
</html>
