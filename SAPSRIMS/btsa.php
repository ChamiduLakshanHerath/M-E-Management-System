<?php include('bts_process.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAPSRI MS: Beneficiary Tracking Sheet</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<script>
function myFunction() {
    var input, filter, table, tr, td, i, j, txtValue, found;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("mybtsTable");
    tr = table.getElementsByTagName("tr");

    
    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        found = false;
        
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break; 
                }
            }
        }
        
        if (found) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
</script>
</head>
<body class="adminbody">
	<section id="sidenavbar">
		<nav class="navbar">
			<a class="navbar-brand" href="#">
			    <img class="brand" src="img/SapsriLogo.png"  alt="">
			</a>
			<h1 class="brandheading">Maintain & Evaluation System</h1>
			<ul class="nav">
				<li><a href="adminpannel.php">Home</a></li>
				<li>
					<a href="Component.php">Main Components</a>
				</li>
				<li>
					<a href="CSODatabase.php">CSO Databases</a>
				</li>
				<li>
					<a href="Monthlyplan.php">Monthly Advance Plan</a>
				</li>
				<li><a href="btsa.php" class="active"></i>Beneficiary Tracking Sheet</a></li>
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
		<h2 class="Awpheading">Program Details</h2>
		<?php $results = mysqli_query($db, "SELECT * FROM bts"); ?>
			<br><br><br><br>
			<div class="searchform-group">
				<input type="text" id="myInput" onkeyup="myFunction();" placeholder="Search here..." class="searchform-control">
			</div><br>
			<table class="table table-striped" id="mybtsTable">
				<thead>
					<tr>
						<th>Date</th>
						<th class="activity">Activity</th>
						<th>Component</th>
						<th class="activitytype">Activity Type</th>
						<th class="dsdv">DS Division</th>
						<th class="gndv">GN Division</th>
						<th class="bm">Male</th>
						<th class="bf">Female</th>
						<th class="tot">Total Participants</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
					<tr>
						<td><?php echo $row['date']; ?></td>
						<td><?php echo $row['activity']; ?></td>
						<td><?php echo $row['componentno']; ?></td>
						<td><?php echo $row['activitytype']; ?></td>
						<td><?php echo $row['dsd']; ?></td>
						<td><?php echo $row['gnd']; ?></td>
						<td><?php echo $row['bmale']; ?></td>
						<td><?php echo $row['bfemale']; ?></td>
						<td><?php echo $row['btotal']; ?></td>
					</tr>
					<?php } ?>
			</table>
	</main>

</body>
</html>