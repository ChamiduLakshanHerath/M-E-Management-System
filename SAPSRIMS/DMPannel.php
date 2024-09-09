<?php
session_start();
include('std_process.php');

// Retrieve user details from session
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$cno = $_SESSION['cno'];
$designationType = $_SESSION['designation'];

// Get completed and pending activities counts for DMAWP
$sql_dmawp_completed = "SELECT COUNT(*) FROM dmawp WHERE status = 'Completed'";
$sql_dmawp_pending = "SELECT COUNT(*) FROM dmawp WHERE status = 'Not Complete'";

$result_dmawp_completed = mysqli_query($db, $sql_dmawp_completed);
$result_dmawp_pending = mysqli_query($db, $sql_dmawp_pending);

$completed_activities_dmawp = ($result_dmawp_completed) ? mysqli_fetch_row($result_dmawp_completed)[0] : 0;
$pending_activities_dmawp = ($result_dmawp_pending) ? mysqli_fetch_row($result_dmawp_pending)[0] : 0;

// Total activities
$query_total_dmawp = "SELECT COUNT(*) as count FROM dmawp";
$result_total_dmawp = $db->query($query_total_dmawp);
$total_dmawp = ($result_total_dmawp) ? $result_total_dmawp->fetch_assoc()['count'] : 0;

// Completed activities
$query_completed_dmawp = "SELECT COUNT(*) as count FROM dmawp WHERE status = 'Completed'";
$result_completed_dmawp = $db->query($query_completed_dmawp);
$completed_dmawp = ($result_completed_dmawp) ? $result_completed_dmawp->fetch_assoc()['count'] : 0;

// Calculate progress percentage for DMAWP
$progressPercentage_dmawp = ($total_dmawp > 0) ? round(($completed_dmawp / $total_dmawp) * 100) : 0;

// Financial progress calculation for DMAWP
$query_dmawp_financial = "SELECT SUM(teutn) AS teutn_sum, SUM(plannedbudget) AS plannedbudget_sum FROM dmawp";
$result_dmawp_financial = $db->query($query_dmawp_financial);
$teutn_total_dmawp = $plannedbudget_total_dmawp = 0;

if ($result_dmawp_financial) {
    $row_dmawp_financial = $result_dmawp_financial->fetch_assoc();
    $teutn_total_dmawp = $row_dmawp_financial['teutn_sum'];
    $plannedbudget_total_dmawp = $row_dmawp_financial['plannedbudget_sum'];
}

// Function to calculate financial progress percentage
function calculateFinancialProgressPercentage($teutn_total, $plannedbudget_total) {
    return ($plannedbudget_total > 0) ? round(($teutn_total / $plannedbudget_total) * 100) : 0;
}

$financialProgressPercentage_dmawp = calculateFinancialProgressPercentage($teutn_total_dmawp, $plannedbudget_total_dmawp);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAPSRI MS: DM Pannel</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body class="adminbody">
	<section id="sidenavbar">
		<nav class="navbar">
			<a class="navbar-brand" href="#">
			    <img class="brand" src="img/SapsriLogo.png"  alt="">
			</a>
			<h1 class="brandheading">Maintain & Evaluation System</h1>
			<ul class="nav">
				<li><a href="DMpannel.php" class="active">Home</a></li>
				<li>
					<a href="DMAWP.php">Annual Work Plan</a>
				</li>
				
				<li>
					<a href="#" class="disabled-link">Monthly Advance Plan</a>
				</li>
				<li><a href="bts.php"></i>Beneficiary Tracking Sheet</a></li>
				<li>
					<a href="login.php">Sign out</a>
				</li>
			</ul>
		</nav>
	</section>
	<main>
	<img class="awpcover" src="img/newcover.png">
	<img class="awplogo" src="img/Whitelogo.png">
	<br><br>
	<div class="welcomecard">
		<div class="row no-gutters">
			<div class="left">
			<img class="welcomecardimg" src="img/welcomecard.jpg" alt="">
			</div>
			<div class="right">
			<div class="card-body" style="text-align:justify;">
				<h5 class="card-title" style="color: #990000;">Welcome</h5><br>
				<p class="card-text" style="padding-left: 20px;">
						Welcome to SAPSRI Management System Portal, <b> <?php echo htmlspecialchars($name); ?></b>.<br>
						Here you can view information and perform actions related to your Project.<br>
						To access additional information and options, please use the menu bar links at the top of this screen.
					</p><br>
			</div>
			</div>
		</div>
	</div>
	
	
        <div class="profilecard">
            <div class="profilecard-header" style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px"><b>My Profile</div>
            <div class="profilecard-body"><br>
			<img class="profilecardimg" src="img/profile.jpg" alt="">
                <div class="profiletext">
                    <div class="form-group row">
                        <label for="fullname" class="profilelabel" style="padding-left: 180px;">Name</label>
                        <div class="coloumn">
                            <input type="text" readonly class="form-control-plaintext" id="fullname" value="<?php echo htmlspecialchars($name); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="profilelabel" style="padding-left: 180px;">Email</label>
                        <div class="coloumn">
                            <input type="email" readonly class="form-control-plaintext" id="email" value="<?php echo htmlspecialchars($email); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="profilelabel" style="padding-left: 180px;">Mobile</label>
                        <div class="coloumn">
                            <input type="text" readonly class="form-control-plaintext" id="mobile" value="<?php echo htmlspecialchars($cno); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="position" class="profilelabel" style="padding-left: 180px;">Position</label>
                        <div class="coloumn">
                            <input type="text" readonly class="form-control-plaintext" id="position" value="<?php echo htmlspecialchars($designationType); ?>">
                        </div></b>
                    </div>
                </div><br>
            </div>
        </div><br><br><br><br>
		<div class="progresscard">
			<div class="progresscard-body">
				<div class="progresscardheader" style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px"><b>Disaster Management</b> </div><br>
				<h8 style="padding-left: 20px;"><b>Physical Progress</b></h8>
				<div class="progress">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $progressPercentage_dmawp; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progressPercentage_dmawp; ?>%;">
						<?php echo $progressPercentage_dmawp; ?>%
					</div>
				</div><br>
				<h8 style="padding-left: 20px;"><b>Financial Progress</b></h8>
				<div class="progress">
					<div class="progress-bar" style="width: <?php echo $financialProgressPercentage_dmawp; ?>%; background-color: #4caf50;">
						<?php echo $financialProgressPercentage_dmawp; ?>%
					</div>
				</div>
			</div>
		</div><br>
	</main>
	
	
</body>
</html>