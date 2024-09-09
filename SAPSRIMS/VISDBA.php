<?php include('Db_vis_process.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAPSRI MS: Database</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<script>
function myFunction() {
    var input, filter, table, tr, td, i, j, txtValue, found;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("mydbTable");
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
					<a href="CSODatabase.php" class="active">CSO Databases</a>
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
		<h2 class="Awpheading">Vilage Irrigation System - Tank Database</h2>
			<?php $results = mysqli_query($db, "SELECT * FROM visdb"); ?>
			<br>
			<div class="searchform-group">
				<input type="text" id="myInput" onkeyup="myFunction();" placeholder="Search here..." class="searchform-control">
			</div>
			<table class="table table-striped" id="mydbTable">
				<thead>
					<tr>
						<th>District</th>
						<th>DS Division</th>
						<th>GN Division</th>
						<th>Cascade Name</th>
						<th>Tank Name</th>
						<th>FO's Name</th>
						<th>No. of Farmers</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
					<tr>
						<td><?php echo $row['district']; ?></td>
						<td><?php echo $row['dsdivision']; ?></td>
						<td><?php echo $row['gntype']; ?></td>
						<td><?php echo $row['cascadetype']; ?></td>
						<td><?php echo $row['tank']; ?></td>
						<td><?php echo $row['foname']; ?></td>
						<td><?php echo $row['fnumber']; ?></td>
					</tr>
					<?php } ?>
			</table>
	</main>
	

</body>
</html>