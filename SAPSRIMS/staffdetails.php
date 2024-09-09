<?php include('std_process.php'); ?>

<?php
    if (isset($_GET['edit'])) {
        $dbid = $_GET['edit'];
        $update = true;
        $result = mysqli_query($db, "SELECT * FROM std WHERE sid=$sid");

        if (mysqli_num_rows($result) == 1) { 
            $n = mysqli_fetch_array($result);
            $name = $n['name'];
            $desiganationtype = $n['desiganationtype'];
            $componenttype = $n['componenttype'];
            $cno = $n['cno'];
            $email = $n['email'];
			$password = $n['password'];
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAPSRI MS: Staff Details</title>
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
    table = document.getElementById("mystdTable");
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
				<li><a href="btsa.php"></i>Beneficiary Tracking Sheet</a></li>
				<li><a href="staffdetails.php" class="active">Staff Details</a></li>
				<li>
					<a href="login.php">Sign out</a>
				</li>
			</ul>
		</nav>
	</section>
	<main>
		<img class="awpcover" src="img/newcover.png">
		<img class="awplogo" src="img/Whitelogo.png">
		<h2 class="Awpheading">Staff Details Management</h2>
		<div class="awpviscard"><br>
			<h8 class="awpviscardcard-title"><b>Staff Detals</b></h8><hr>
			<form method="post" action="std_process.php">
				<input type="hidden" name="sid" value="<?php echo $sid; ?>">
				<div class="form-std1">
					<label for="name" class="std-lable1"><b>Full Name</label>
					<input type="text" name="name" id="name" class="formstd-control1" value="<?php echo $name; ?>">
				</div>
				<div class="form-std2">
					<label for="desiganationtype" class="std-lable2">Designation:</label>
					<select name="desiganationtype" id="desiganationtype">
						<option value="Administrator" <?php if ($desiganationtype === 'Administrator') echo 'checked' ; ?>>Administrator</option>
					    <option value="District Coordinator" <?php if ($desiganationtype === 'District Coordinator') echo 'checked' ; ?>>District Coordinator</option>
						<option value="CSA - Social Mobilizer" <?php if ($desiganationtype === 'CSA - Social Mobilizer') echo 'checked' ; ?>>CSA - Social Mobilizer</option>
						<option value="VIS - Social Mobilizer" <?php if ($desiganationtype === 'VIS - Social Mobilizer') echo 'checked' ; ?>>VIS - Social Mobilizer</option>
						<option value="Componenet 02 - Social Mobilizer" <?php if ($desiganationtype === 'Componenet 02 - Social Mobilizer') echo 'checked' ; ?>>Componenet 02 - Social Mobilizer</option>
						<option value="DM - Social Mobilizer" <?php if ($desiganationtype === 'DM - Social Mobilizer') echo 'checked' ; ?>>DM - Social Mobilizer</option>
					</select>
				</div>
				<div class="form-std3">
					<label for="componenttype" class="std-lable3">Component:</label>
					<select name="componenttype" id="componenttype">
						<option value="Coordinator" <?php if ($componenttype === 'Coordinator') echo 'checked' ; ?>>Coordinator</option>
						<option value="Component 01 - CSA" <?php if ($componenttype === 'Component 01 - CSA') echo 'checked' ; ?>>Component 01 - CSA</option>
						<option value="Component 01 - VIS" <?php if ($componenttype === 'Component 01 - VIS') echo 'checked' ; ?>>Component 01 - VIS</option>
						<option value="Component 02" <?php if ($componenttype === 'Component 02') echo 'checked' ; ?>>Component 02</option>
						<option value="Component 03" <?php if ($componenttype === 'Component 03') echo 'checked' ; ?>>Component 03</option>
					</select>
				</div>				
				<div class="form-std4">
					<label for="cno" class="std-lable4">Mobile No.</label>
					<input type="text" name="cno" id="cno" class="formstd-control4" value="<?php echo $cno; ?>">
				</div><br>
				<div class="form-std5">
					<label for="email" class="std-lable5">Email Address</label>
					<input type="email" name="email" id="email" class="formstd-control5" value="<?php echo $email; ?>">
				</div>
				<div class="form-std6">
					<label for="password" class="std-lable6">Password</label>
					<input type="password" name="password" id="password" class="formstd-control6" value="<?php echo $password; ?>">
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
			<?php $results = mysqli_query($db, "SELECT * FROM std"); ?>
			<br>
			<div class="searchform-group">
				<input type="text" id="myInput" onkeyup="myFunction();" placeholder="Search here..." class="searchform-control">
			</div>
			<table class="table table-striped" id="mystdTable">
				<thead>
					<tr>
						<th>Name</th>
						<th>Designation</th>
						<th>Component</th>
						<th>Mobile No</th>
						<th>Email Address</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['desiganationtype']; ?></td>
						<td><?php echo $row['componenttype']; ?></td>
						<td><?php echo $row['cno']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td>
							<a href="staffdetails.php?edit=<?php echo $row['sid']; ?>" class="btn btn-info">Edit</a>
						</td>
						<td>
							<a href="std_process.php?del=<?php echo $row['sid']; ?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					<?php } ?>
					
			</table>
	</main>
	

</body>
</html>