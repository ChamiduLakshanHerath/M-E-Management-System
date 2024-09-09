<?php include('awp_admin_csa_process.php'); ?>

<?php
    if (isset($_GET['edit'])) {
        $awpid = $_GET['edit'];
        $update = true;
        $result = mysqli_query($db, "SELECT * FROM csaawp WHERE awpid=$awpid");

        if (mysqli_num_rows($result) == 1) { 
            $n = mysqli_fetch_array($result);
            $activitynumber = $n['activitynumber'];
            $mainactivity = $n['mainactivity'];
            $plannedbudget = $n['plannedbudget'];
            $teutn = $n['teutn'];
            $status = $n['status'];
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Annual Work Plan</title>
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
    table = document.getElementById("myTable");
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
					<a href="Component.php" class="active">Main Components</a>
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
		<h2 class="Awpheading">Climate Smart Aggriculture (CSA)</h2>
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
		<div class="awpviscard"><br>
			<h8 class="awpviscardcard-title"><b>Annual Work Plan</b></h8><hr>
			<form method="post" action="awp_admin_csa_process.php">
			<input type="hidden" name="awpid" value="<?php echo $awpid; ?>">
				<div class="form-awpvis1">
					<label for="activitynumber" class="awpvis-lable1"><b>Activity Number</label>
					<input type="text" name="activitynumber" id="activitynumber" class="formawpvis-control1" value="<?php echo $activitynumber; ?>">
				</div>
				<div class="form-awpvis2">
					<label for="mainactivity" class="awpvis-lable2">Main Activity</label>
					<input type="text" name="mainactivity" id="mainactivity" class="formawpvis-control2" value="<?php echo $mainactivity; ?>">
				</div>
				<div class="form-awpvis3">
					<label for="plannedbudget" class="awpvis-lable3">Planned Budget (LKR)</label>
					<input type="number" name="plannedbudget" id="plannedbudget" class="formawpvis-control3" value="<?php echo $plannedbudget; ?>">
				</div>
				<div class="form-awpvis4">
					<label for="teutn" class="awpvis-lable4">Total Expenditure</label>
					<input type="number" name="teutn" id="teutn" class="formawpvis-control4" value="<?php echo $plannedbudget; ?>">
				</div><br>
				<div class="form-awpvis5">
					<label for="status" class="awpvis-lable5">Activity Status</label>
					<input type="radio" id="completed" name="status" value="Completed" <?php if($status === 'Completed') echo 'checked'; ?>>
				 	<label for="status">Completed</label>
				 	<input type="radio" id="notcomplete" name="status" value="Not Complete" <?php if($status === 'Not Complete') echo 'checked'; ?>>
				 	<label for="status">Not Complete</label>
			 	</div></b>
				 <div class="awpvisform-btn">
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
		<?php $results = mysqli_query($db, "SELECT * FROM csaawp"); ?>
			<br>
			<div class="searchform-group">
				<input type="text" id="myInput" onkeyup="myFunction();" placeholder="Search here..." class="searchform-control">
			</div>			
			<table class="table table-striped" id="myTable">
				<thead>
					<tr>
						<th>Activity Number</th>
						<th>Main Activity</th>
						<th>Planned Budget</th>
						<th>Total Expenditure</th>
						<th>Activity Status</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
					<tr>
						<td><?php echo $row['activitynumber']; ?></td>
						<td><?php echo $row['mainactivity']; ?></td>
						<td><?php echo $row['plannedbudget']; ?></td>
						<td><?php echo $row['teutn']; ?></td>
						<td><?php echo $row['status']; ?></td>
						<td>
							<a href="CSAAWPA.php?edit=<?php echo $row['awpid']; ?>" class="btn btn-info">Edit</a>
						</td>
						<td>
							<a href="awp_admin_csa_process.php?del=<?php echo $row['awpid']; ?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					<?php } ?>
			</table>
	</main>

</body>
</html>