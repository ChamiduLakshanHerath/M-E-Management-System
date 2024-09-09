<?php include('bts_process.php'); ?>

<?php
    if (isset($_GET['edit'])) {
        $dbid = $_GET['edit'];
        $update = true;
        $result = mysqli_query($db, "SELECT * FROM bts WHERE dbid=$dbid");

        if (mysqli_num_rows($result) == 1) { 
            $n = mysqli_fetch_array($result);
            $date = $n['date'];
            $activity = $n['activity'];
            $componentno = $n['componentno'];
            $activitytype = $n['activitytype'];
            $dsd = $n['dsd'];
            $gnd = $n['gnd'];
			$bmale = $n['bmale'];
			$bfemale = $n['bfemale'];
			$btotal = $n['btotal'];
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAPSRI MS: Beneficiary Tracking Sheet</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 2000);
</script>
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
<script>
function updateTotal() {
    var bmale = parseFloat(document.getElementById('bmale').value) || 0;
    var bfemale = parseFloat(document.getElementById('bfemale').value) || 0;
    var btotal = bmale + bfemale;
    document.getElementById('btotal').value = btotal;
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
				<li><a href="#" >Home</a></li>
				<li>
					<a href="#">Annual Work Plan</a>
				</li>
				<li>
					<a href="#">Databases</a>
				</li>
				<li>
					<a href="#" class="disabled-link">Monthly Advance Plan</a>
				</li>
				<li><a href="bts.php" class="active"></i>Beneficiary Tracking Sheet</a></li>
				<li>
					<a href="login.php">Sign out</a>
				</li>
			</ul>
		</nav>
	</section>
	<main>
		<img class="awpcover" src="img/newcover.png">
		<img class="awplogo" src="img/Whitelogo.png">
		<h2 class="Awpheading">Beneficiary Trackig Sheet</h2>
		<?php

		if (isset($_SESSION['message'])):

		?>
			<div class="alert alert-<?= $_SESSION['msg_type'] ?>">
		<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
		?>
			</div>
		<?php

		endif

		?>
		<div class="btscard"><br>
			<h8 class="btscardcard-title"><b>Program Details</b></h8><hr>
			<form method="post" action="bts_process.php">
			<input type="hidden" name="dbid" value="<?php echo $dbid; ?>">
				<div class="form-bts1">
					<label for="date" class="bts-lable1"><b>Date</b></label>
					<input type="date" name="date" id= "date" class="formbts-control1" value="<?php echo $date; ?>">
				</div>
				<div class="form-bts2">
					<label for="activity" class="bts-lable1"><b>Activity</b></label>
					<input type="text" name="activity" id="activity" class="formbts-control1" value="<?php echo $activity; ?>">
				</div>

				<div class="form-bts3">
					<label for="componentno" class="bts-lable2"><b>Component No</b></label>
					<input type="text" name="componentno" id="componentno" class="formbts-control2" value="<?php echo $componentno; ?>">
				</div>

				<div class="form-bts4">
					<label for="activitytype" class="bts-lable3"><b>Activity Type</b></label>
					<input type="text" name="activitytype" id="activitytype" class="formbts-control3" value="<?php echo $activitytype; ?>">
				</div>

				<div class="form-bts5">
					<label for="dsd" class="bts-lable4"><b>Divisional Secretariate Division</b></label>
					<input type="text" name="dsd" id="dsd" class="formbts-control4" value="<?php echo $dsd; ?>">
				</div>

				<div class="form-bts6">
					<label for="gnd" class="bts-lable5"><b>Grama Niladhari Division</b></label>
					<input type="text" name="gnd" id="gnd" class="formbts-control5" value="<?php echo $gnd; ?>">
				</div>

				<div class="form-bts7">
					<label for="bmale" class="bts-lable6"><b>Male</b></label>
					<input type="number" name="bmale" id="bmale" class="formbts-control6" value="<?php echo $bmale; ?>" oninput="updateTotal()">
				</div>

				<div class="form-bts8">
					<label for="bfemale" class="bts-lable7"><b>Female</b></label>
					<input type="number" name="bfemale" id="bfemale" class="formbts-control7" value="<?php echo $bfemale; ?>" oninput="updateTotal()">
				</div>

				<div class="form-bts9">
					<label for="btotal" class="bts-lable8"><b>Total</b></label>
					<input type="number" name="btotal" id="btotal" class="formbts-control8" value="<?php echo $btotal; ?>" readonly>
				</div>
				<div class="btsform-btn">
					<?php if ($update == true): ?>
						<input type="submit" name="update" class="ubtn" value="Update">
					<?php else: ?>
						<input type="submit" name="save" class="btn" value="Save">
					<?php endif ?>
				</div>
				<br>
			</form>
		</div>
		<br>
		<br>
			<?php $results = mysqli_query($db, "SELECT * FROM bts"); ?>
			<br>
			<div class="searchform-group">
				<input type="text" id="myInput" onkeyup="myFunction();" placeholder="Search here..." class="searchform-control">
			</div>
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
						<th colspan="2">Action</th>
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
						<td>
							<a href="bts.php?edit=<?php echo $row['dbid']; ?>" class="btn btn-info">Edit</a>
						</td>
						<td>
							<a href="bts_process.php?del=<?php echo $row['dbid']; ?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					<?php } ?>
			</table>
	</main>
</body>
</html>