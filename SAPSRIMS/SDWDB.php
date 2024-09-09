<?php include('Db_sw_process.php'); ?>

<?php
    if (isset($_GET['edit'])) {
        $dbid = $_GET['edit'];
        $update = true;
        $result = mysqli_query($db, "SELECT * FROM sdwdb WHERE dbid=$dbid");

        if (mysqli_num_rows($result) == 1) { 
            $n = mysqli_fetch_array($result);
            $district = $n['district'];
            $dsdivision = $n['dsdivision'];
            $gntype = $n['gntype'];
            $name = $n['name'];
            $benefit = $n['benefit'];
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAPSRI MS: Database</title>
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
				<li><a href="SDWPannel.php" >Home</a></li>
				<li>
					<a href="SDWAWP.php">Annual Work Plan</a>
				</li>
				<li>
					<a href="SDWBD.php" class="active">Databases</a>
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
		<h2 class="Awpheading">Safe Drinking Water - Beneficiary Database </h2>
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
		<div class="rwhsdbcard"><br>
			<h8 class="rwhsdbcardcard-title"><b>Beneficiary Detals </b></h8><hr>
			<form method="post" action="Db_sw_process.php">
				<input type="hidden" name="dbid" value="<?php echo $dbid; ?>">
				<div class="form-sdb1">
					<label for="district" class="vdb-lable1"><b>District</label>
					<input type="text" name="district" id="district" class="formvdb-control1" value="<?php echo $district; ?>">
				</div>
				<div class="form-sdb2">
					<label for="dsdivision" class="vdb-lable2">DS Division:</label>
					<select name="dsdivision" id="dsdivision">
						<option value="Anamaduwa" <?php if ($dsdivision === 'Anamaduwa') echo 'checked' ; ?>>Anamaduwa</option>
					    <option value="Nawagattegama" <?php if ($dsdivision === 'Nawagattegama') echo 'checked' ; ?>>Nawagattegama</option>
					</select>
				</div><br>
				<div class="form-sdb3">
				<label for="gntype" class="vdb-lable3">GN Division:</label>
					<select name="gntype" id="gntype">
					    <option value="Ramabakanayagama" <?php if ($gntype === 'Ramabakanayagama') echo 'checked' ; ?>>Ramabakanayagama</option>
					    <option value="Moragahawewa" <?php if ($gntype === 'Moragahawewa') echo 'checked' ; ?>>Moragahawewa</option>
					    <option value="Maha Meddewa" <?php if ($gntype === 'Maha Meddewa') echo 'checked' ; ?>>Maha Meddewa</option>
					</select>
				</div>				
				<div class="form-sdb4">
					<label for="name"class="sdb-lable4">Beneficiary Name</label>
					<input type="text" name="name" id="name" class="formsdb-control4" value="<?php echo $name; ?>">
				</div>
				<div class="form-sdb5">
				<label for="benefit" class="vdb-lable5">Benefits:</label>
					<select name="benefit" id="benefit">
					    <option value="Rainwater Harvesting System" <?php if ($benefit === 'Rainwater Harvesting System') echo 'checked' ; ?>>Rainwater Harvesting System</option>
					    <option value="Water connection" <?php if ($benefit === 'Water connection') echo 'checked' ; ?>>Water connection</option>
					</select>
				</div><br>
				
				<div class="visform-btn">
					<?php if ($update == true): ?>
						<input type="submit" name="update" class="ubtn" value="Update">
					<?php else: ?>
						<input type="submit" name="save" class="btn" value="Save">
					<?php endif ?>
				</div>
				<br>
			</form>
		</div>
		<?php $results = mysqli_query($db, "SELECT * FROM sdwdb"); ?>
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
						<th>Beneficiary Name</th>
						<th>Benefits</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
					<tr>
						<td><?php echo $row['district']; ?></td>
						<td><?php echo $row['dsdivision']; ?></td>
						<td><?php echo $row['gntype']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['benefit']; ?></td>
						<td>
							<a href="SDWDB.php?edit=<?php echo $row['dbid']; ?>" class="btn btn-info">Edit</a>
						</td>
						<td>
							<a href="Db_sw_process.php?del=<?php echo $row['dbid']; ?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					<?php } ?>
			</table>
	</main>
	

</body>
</html>