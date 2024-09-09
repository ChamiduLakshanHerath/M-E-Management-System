<?php
session_start();
include('std_process.php');

// Retrieve user details from session
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$cno = $_SESSION['cno'];
$designationType = $_SESSION['designation'];
?>


<?php
// Assuming $db is already initialized and connected

$completed_activities_swawp = 0;
$completed_activities_dmawp = 0;
$completed_activities_visawp = 0;
$completed_activities_csaawp = 0;

$sql_swawp = "SELECT COUNT(*) FROM swawp WHERE status = 'Completed'";
$sql_dmawp = "SELECT COUNT(*) FROM dmawp WHERE status = 'Completed'";
$sql_visawp = "SELECT COUNT(*) FROM visawp WHERE status = 'Completed'";
$sql_csaawp = "SELECT COUNT(*) FROM csaawp WHERE status = 'Completed'";

$result_swawp = mysqli_query($db, $sql_swawp);
$result_dmawp = mysqli_query($db, $sql_dmawp);
$result_visawp = mysqli_query($db, $sql_visawp);
$result_csaawp = mysqli_query($db, $sql_csaawp);

if ($result_swawp) {
    $completed_activities_swawp = mysqli_fetch_row($result_swawp)[0];    
}
if ($result_dmawp) {
    $completed_activities_dmawp = mysqli_fetch_row($result_dmawp)[0];    
}
if ($result_visawp) {
    $completed_activities_visawp = mysqli_fetch_row($result_visawp)[0];    
}
if ($result_csaawp) {
    $completed_activities_csaawp = mysqli_fetch_row($result_csaawp)[0];    
}

$total_completed_activities = $completed_activities_swawp + $completed_activities_dmawp + $completed_activities_visawp + $completed_activities_csaawp;

$pending_activities_swawp = 0;
$pending_activities_dmawp = 0;
$pending_activities_visawp = 0;
$pending_activities_csaawp = 0;

$sql_swawp = "SELECT COUNT(*) FROM swawp WHERE status = 'Not Complete'";
$sql_dmawp = "SELECT COUNT(*) FROM dmawp WHERE status = 'Not Complete'";
$sql_visawp = "SELECT COUNT(*) FROM visawp WHERE status = 'Not Complete'";
$sql_csaawp = "SELECT COUNT(*) FROM csaawp WHERE status = 'Not Complete'";

$result_swawp = mysqli_query($db, $sql_swawp);
$result_dmawp = mysqli_query($db, $sql_dmawp);
$result_visawp = mysqli_query($db, $sql_visawp);
$result_csaawp = mysqli_query($db, $sql_csaawp);

if ($result_swawp) {
    $pending_activities_swawp = mysqli_fetch_row($result_swawp)[0];    
}
if ($result_dmawp) {
    $pending_activities_dmawp = mysqli_fetch_row($result_dmawp)[0];    
}
if ($result_visawp) {
    $pending_activities_visawp = mysqli_fetch_row($result_visawp)[0];    
}
if ($result_csaawp) {
    $pending_activities_csaawp = mysqli_fetch_row($result_csaawp)[0];    
}

$total_pending_activities = $pending_activities_swawp + $pending_activities_dmawp + $pending_activities_visawp + $pending_activities_csaawp;

$query_swawp = "SELECT COUNT(*) as count FROM swawp";
$query_dmawp = "SELECT COUNT(*) as count FROM dmawp";
$query_visawp = "SELECT COUNT(*) as count FROM visawp";
$query_csaawp = "SELECT COUNT(*) as count FROM csaawp";

$result_swawp = $db->query($query_swawp);
$result_dmawp = $db->query($query_dmawp);
$result_visawp = $db->query($query_visawp);
$result_csaawp = $db->query($query_csaawp);

if ($result_swawp && $result_dmawp && $result_visawp && $result_csaawp) {
    $row_swawp = $result_swawp->fetch_assoc();
    $row_dmawp = $result_dmawp->fetch_assoc();
    $row_visawp = $result_visawp->fetch_assoc();
    $row_csaawp = $result_csaawp->fetch_assoc();

    $totalActivities = $row_swawp['count'] + $row_dmawp['count'] + $row_visawp['count'] + $row_csaawp['count'];
}

$progressPercentage = ($total_completed_activities / $totalActivities) * 100;
$roundedPercentage = round($progressPercentage);

$query_total_csaawp = "SELECT COUNT(*) as count FROM csaawp";
$result_total_csaawp = $db->query($query_total_csaawp);

if ($result_total_csaawp) {
    $row_total_csaawp = $result_total_csaawp->fetch_assoc();
    $total_csaawp = $row_total_csaawp['count'];
}

// Query to get the number of completed activities in csaawp
$query_completed_csaawp = "SELECT COUNT(*) as count FROM csaawp WHERE status = 'Completed'";
$result_completed_csaawp = $db->query($query_completed_csaawp);

if ($result_completed_csaawp) {
    $row_completed_csaawp = $result_completed_csaawp->fetch_assoc();
    $completed_csaawp = $row_completed_csaawp['count'];
}

// Calculate the progress percentage for csaawp
$progressPercentage_csaawp = 0;

if ($total_csaawp > 0) { // To avoid division by zero
    $progressPercentage_csaawp = ($completed_csaawp / $total_csaawp) * 100;
    $progressPercentage_csaawp = round($progressPercentage_csaawp); // Round to the nearest whole number if needed
}
// Query to get the total number of activities in swawp, visawp, and dmawp
$query_total_swawp = "SELECT COUNT(*) as count FROM swawp";
$query_total_visawp = "SELECT COUNT(*) as count FROM visawp";
$query_total_dmawp = "SELECT COUNT(*) as count FROM dmawp";

$result_total_swawp = $db->query($query_total_swawp);
$result_total_visawp = $db->query($query_total_visawp);
$result_total_dmawp = $db->query($query_total_dmawp);

$total_swawp = $total_visawp = $total_dmawp = 0;

if ($result_total_swawp) {
    $row_total_swawp = $result_total_swawp->fetch_assoc();
    $total_swawp = $row_total_swawp['count'];
}

if ($result_total_visawp) {
    $row_total_visawp = $result_total_visawp->fetch_assoc();
    $total_visawp = $row_total_visawp['count'];
}

if ($result_total_dmawp) {
    $row_total_dmawp = $result_total_dmawp->fetch_assoc();
    $total_dmawp = $row_total_dmawp['count'];
}

// Query to get the number of completed activities in swawp, visawp, and dmawp
$query_completed_swawp = "SELECT COUNT(*) as count FROM swawp WHERE status = 'Completed'";
$query_completed_visawp = "SELECT COUNT(*) as count FROM visawp WHERE status = 'Completed'";
$query_completed_dmawp = "SELECT COUNT(*) as count FROM dmawp WHERE status = 'Completed'";

$result_completed_swawp = $db->query($query_completed_swawp);
$result_completed_visawp = $db->query($query_completed_visawp);
$result_completed_dmawp = $db->query($query_completed_dmawp);

$completed_swawp = $completed_visawp = $completed_dmawp = 0;

if ($result_completed_swawp) {
    $row_completed_swawp = $result_completed_swawp->fetch_assoc();
    $completed_swawp = $row_completed_swawp['count'];
}

if ($result_completed_visawp) {
    $row_completed_visawp = $result_completed_visawp->fetch_assoc();
    $completed_visawp = $row_completed_visawp['count'];
}

if ($result_completed_dmawp) {
    $row_completed_dmawp = $result_completed_dmawp->fetch_assoc();
    $completed_dmawp = $row_completed_dmawp['count'];
}

// Calculate the progress percentage for swawp, visawp, and dmawp
$progressPercentage_swawp = $progressPercentage_visawp = $progressPercentage_dmawp = 0;

if ($total_swawp > 0) { // To avoid division by zero
    $progressPercentage_swawp = ($completed_swawp / $total_swawp) * 100;
    $progressPercentage_swawp = round($progressPercentage_swawp);
}

if ($total_visawp > 0) { // To avoid division by zero
    $progressPercentage_visawp = ($completed_visawp / $total_visawp) * 100;
    $progressPercentage_visawp = round($progressPercentage_visawp);
}

if ($total_dmawp > 0) { // To avoid division by zero
    $progressPercentage_dmawp = ($completed_dmawp / $total_dmawp) * 100;
    $progressPercentage_dmawp = round($progressPercentage_dmawp);
}
$teutn_total_csaawp = 0;
$plannedbudget_total_csaawp = 0;
$teutn_total_visawp = 0;
$plannedbudget_total_visawp = 0;
$teutn_total_swawp = 0;
$plannedbudget_total_swawp = 0;
$teutn_total_dmawp = 0;
$plannedbudget_total_dmawp = 0;

// Function to calculate financial progress percentage

function calculateFinancialProgressPercentage($teutn_total, $plannedbudget_total) {
    if ($plannedbudget_total > 0) { // To avoid division by zero
        $financialProgressPercentage = ($teutn_total / $plannedbudget_total) * 100;
        return round($financialProgressPercentage); // Round to two decimal places
    }
    return 0; // Return 0 if no planned budget
}


// Query to get total teutn and plannedbudget for csaawp
$query_csaawp = "SELECT SUM(teutn) AS teutn_sum, SUM(plannedbudget) AS plannedbudget_sum FROM csaawp";
$result_csaawp = $db->query($query_csaawp);

if ($result_csaawp) {
    $row_csaawp = $result_csaawp->fetch_assoc();
    $teutn_total_csaawp = $row_csaawp['teutn_sum'];
    $plannedbudget_total_csaawp = $row_csaawp['plannedbudget_sum'];
}

// Calculate financial progress percentage for csaawp
$financialProgressPercentage_csaawp = calculateFinancialProgressPercentage($teutn_total_csaawp, $plannedbudget_total_csaawp);

// Query to get total teutn and plannedbudget for visawp
$query_visawp = "SELECT SUM(teutn) AS teutn_sum, SUM(plannedbudget) AS plannedbudget_sum FROM visawp";
$result_visawp = $db->query($query_visawp);

if ($result_visawp) {
    $row_visawp = $result_visawp->fetch_assoc();
    $teutn_total_visawp = $row_visawp['teutn_sum'];
    $plannedbudget_total_visawp = $row_visawp['plannedbudget_sum'];
}

// Calculate financial progress percentage for visawp
$financialProgressPercentage_visawp = calculateFinancialProgressPercentage($teutn_total_visawp, $plannedbudget_total_visawp);

// Query to get total teutn and plannedbudget for swawp
$query_swawp = "SELECT SUM(teutn) AS teutn_sum, SUM(plannedbudget) AS plannedbudget_sum FROM swawp";
$result_swawp = $db->query($query_swawp);

if ($result_swawp) {
    $row_swawp = $result_swawp->fetch_assoc();
    $teutn_total_swawp = $row_swawp['teutn_sum'];
    $plannedbudget_total_swawp = $row_swawp['plannedbudget_sum'];
}

// Calculate financial progress percentage for swawp
$financialProgressPercentage_swawp = calculateFinancialProgressPercentage($teutn_total_swawp, $plannedbudget_total_swawp);

// Query to get total teutn and plannedbudget for dmawp
$query_dmawp = "SELECT SUM(teutn) AS teutn_sum, SUM(plannedbudget) AS plannedbudget_sum FROM dmawp";
$result_dmawp = $db->query($query_dmawp);

if ($result_dmawp) {
    $row_dmawp = $result_dmawp->fetch_assoc();
    $teutn_total_dmawp = $row_dmawp['teutn_sum'];
    $plannedbudget_total_dmawp = $row_dmawp['plannedbudget_sum'];
}

// Calculate financial progress percentage for dmawp
$financialProgressPercentage_dmawp = calculateFinancialProgressPercentage($teutn_total_dmawp, $plannedbudget_total_dmawp);

// Total financial progress calculation
$total_teutn = $teutn_total_csaawp + $teutn_total_visawp + $teutn_total_swawp + $teutn_total_dmawp;
$total_plannedbudget = $plannedbudget_total_csaawp + $plannedbudget_total_visawp + $plannedbudget_total_swawp + $plannedbudget_total_dmawp;

$financialProgressPercentage_total = calculateFinancialProgressPercentage($total_teutn, $total_plannedbudget);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAPSRI MS: Admin</title>
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
				<li><a href="adminpannel.php" class="active">Home</a></li>
				<li>
					<a href="Component.php">Main Components</a>
				</li>
				<li>
					<a href="CSODatabase.php">CSO Databases</a>
				</li>
				<li>
					<a href="Monthlyplan.php">Monthly Advance Plan</a>
				</li>
				<li><a href="btsa.php"></i>Beneficiary Tracking Sheet</a></li>
				<li><a href="staffdetails.php">Staff Details</a></li>
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
		<div class="overallprogresscard">
            <div class="overallprogresscard-body">
                <div class="overallheading" style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px"><b>Project</b></div><br>
                <div class="progress" style="width: 1200px; margin-left: 80px;" role="progressbar" aria-valuenow="<?php echo $roundedPercentage; ?>" aria-valuemin="0" aria-valuemax="100">
					<div class="progress-bar progress-bar-success" style="width: <?php echo $roundedPercentage; ?>%;">
						<span class="progress-text"><?php echo $roundedPercentage; ?>%</span>
					</div>
				</div><br>
				<div class="progress" style="width: 1200px; margin-left: 80px;" margin>
				<div class="progress-bar" style="width: <?php echo $financialProgressPercentage_total; ?>%; background-color: #4caf50;">
					<?php echo $financialProgressPercentage_total; ?>%
				</div>
			</div>
			<br>
                <b>
                    <p class="totalac">Total Activities: <span class="squaretot" style="width: 20px; display: inline-block;"><?php echo $totalActivities; ?></span></p>
                    <p class="completedac">Completed Activities: <span class="squaretc" style="width: 20px; display: inline-block;"><?php echo $total_completed_activities; ?></span></p>
                    <p class="pendingac">Pending Activities: <span class="squarettp" style="width: 20px; display: inline-block;"><?php echo $total_pending_activities; ?></span></p>
                </b>
            </div>
        </div>
		</div><br>
		<div class="progresscard">
			<div class="progresscard-body">
				<div class="progresscardheader" style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px"><b>Climate Smart Agriculture</div><br>
				<h8 style="padding-left: 20px;">Physical Progress</h8></b>
				<div class="progress" style="width: 800px; margin-left: 80px;">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $progressPercentage_csaawp; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progressPercentage_csaawp; ?>%;">
						<?php echo $progressPercentage_csaawp; ?>%
					</div>
				</div><br>
				<h8 style="padding-left: 20px;"><b>Financial Progress</b></h8>
				<div class="progress" style="width: 800px; margin-left: 80px;">
					<div class="progress-bar" style="width: <?php echo $financialProgressPercentage_csaawp; ?>%; background-color: #4caf50;">
						<?php echo $financialProgressPercentage_csaawp; ?>%
					</div>
				</div>
			</div>
		</div><br>
		<div class="progresscard">
			<div class="progresscard-body">
				<div class="progresscardheader" style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px"><b>Village Irrigation System </div><br>
				<h8 style="padding-left: 20px;">Physical Progress</h8></b>
				<div class="progress" style="width: 800px; margin-left: 80px;">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $progressPercentage_visawp; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progressPercentage_visawp; ?>%;">
						<?php echo $progressPercentage_visawp; ?>%
					</div>
				</div><br>
				<h8 style="padding-left: 20px;"><b>Financial Progress</b></h8>
				<div class="progress" style="width: 800px; margin-left: 80px;">
					<div class="progress-bar" style="width: <?php echo $financialProgressPercentage_visawp; ?>%; background-color: #4caf50;">
						<?php echo $financialProgressPercentage_visawp; ?>%
					</div>
				</div>
			</div>
		</div><br>
		<div class="progresscard">
			<div class="progresscard-body">
				<div class="progresscardheader" style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px"><b>Safe Drinking Water </div><br>
				<h8 style="padding-left: 20px;">Physical Progress</h8></b>
				<div class="progress" style="width: 800px; margin-left: 80px;">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $progressPercentage_swawp; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progressPercentage_swawp; ?>%;">
						<?php echo $progressPercentage_swawp; ?>%
					</div>
				</div><br>
				<h8 style="padding-left: 20px;"><b>Financial Progress</b></h8>
				<div class="progress" style="width: 800px; margin-left: 80px;">
					<div class="progress-bar" style="width: <?php echo $financialProgressPercentage_swawp; ?>%; background-color: #4caf50;">
						<?php echo $financialProgressPercentage_swawp; ?>%
					</div>
				</div>
			</div>
		</div><br>
		<div class="progresscard">
			<div class="progresscard-body">
				<div class="progresscardheader" style="padding-left: 20px; padding-top: 5px; padding-bottom: 5px"><b>Disaster Management </div><br>
				<h8 style="padding-left: 20px;">Physical Progress</h8></b>
				<div class="progress" style="width: 800px; margin-left: 80px;">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $progressPercentage_dmawp; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progressPercentage_dmawp; ?>%;">
						<?php echo $progressPercentage_dmawp; ?>%
					</div>
				</div><br>
				<h8 style="padding-left: 20px;"><b>Financial Progress</b></h8>
				<div class="progress" style="width: 800px; margin-left: 80px;">
					<div class="progress-bar" style="width: <?php echo $financialProgressPercentage_dmawp; ?>%; background-color: #4caf50;">
						<?php echo $financialProgressPercentage_dmawp; ?>%
					</div>
				</div>
			</div>
		</div><br>
	</main>
	
</body>
</html>