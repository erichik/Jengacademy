

<!DOCTYPE html>
<html>
	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>首頁 | 錚學院</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include('config/js.php'); ?>
		<?php include('config/css.php'); ?>
		<?php include('config/setup.php'); ?>
		<script src="config/sortablejs.js"></script>


	</head>
	<body>
		<div class="container">		
			<form action="" method="post">
	    		<div class="form-group">
				    <label for="code">資料庫代碼</label>
				    <input type="text" class="form-control" name="code" id="code" value="<?php if(isset($_POST['code'])){echo $_POST['code'];}?>">
				</div>
			    <input type="submit" name="save" value="送出">
	    	</form>
	    	<div id="sortMe" class="list-group">
			<?php
				if(isset($_POST['save'])){
	    			$tablename = $_POST['code'];

					$q = "SELECT * FROM $tablename ORDER BY orderid ASC";
					mysqli_query($dbc, "SET NAMES utf8");					
					$r = mysqli_query($dbc, $q);
					$i = 1;
					while($row = mysqli_fetch_assoc($r)) {
						echo "<div href='#' class='alert alert-info' role='alert' id='order_".$i."'>".$row['question']."</div>";
						$i++;
					} 
				}
			?>
			</div>
		</div>
	</body>
</html>