<?php 
/*
	include 'config/setup.php'; 

	$dbc = mysqli_connect('182.50.133.77', 'eric', 'eric0517', 'jengacademy') OR die('Error: '.mysqli_connect_error());
	mysqli_query($dbc, "SET NAMES utf8");
	$structure = structure_page($dbc, 1);
	*/
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><?php/* echo $structure['keypoint'].' | '.$structure['chapter'] */?> | 錚學院</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include 'config/js.php'; ?>
		<?php include 'config/css.php'; ?>
		
	</head>
	<body>
	
	<!--Navbar-->
	<?php include('template/nav.php'); ?>
	<br><br><br>
	
		
	
	<div class="container">
		<div class="page-header">
  			<h1><?php/* echo $structure['keypoint'] */?><small>觀念練習</small></h1>
		</div>
		<?php
			if(isset($_GET['page']) AND ($_GET['page'] > 0)){
				$pageid = $_GET['page'];
			}else{
				$pageid = 1;
			}
		?>
		<?php
			if(isset($_GET['pracid'])){
				$pracid = $_GET['pracid'];
			}
		?>
		<!-- connect the database to query the question -->
		<?php
		
			$mathcon = mysqli_connect('182.50.133.77', 'jenginput', 'eric0517', 'insertdb') OR die('Error: '.mysqli_connect_error());
			$qa = "SELECT * FROM ".$pracid." WHERE orderid = '$pageid'";
			mysqli_query($mathcon, "SET NAMES utf8");
			$result = mysqli_query($mathcon, $qa);
			$md = mysqli_fetch_assoc($result);
			

			$qnum = "SELECT max(orderid) AS maxnum FROM ".$pracid;
			$resultnum = mysqli_query($mathcon, $qnum);
			$rn = mysqli_fetch_assoc($resultnum);
			
		?>
		<!--progress bar-->
		<h4><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>  完成度</h4>
		<div class="progress">
		  <div class="progress-bar progress-bar-success" style="width: <?php echo ($pageid-1)*100/$rn['maxnum']; ?>%">
		  </div>
		  <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: <?php echo 100/$rn['maxnum']; ?>%">
		  </div>
		</div>
		
		
		<!-- question panel-->
		<div class="panel panel-info">
			<div class="panel-heading">
			    <h3 class="panel-title">練習</h3>
			</div>
			<div class="panel-body">
			  
				<?php
					$qnew = "SELECT question, answer FROM ".$pracid." WHERE orderid = '$pageid'";
					$r = mysqli_query($mathcon, $qnew);
					if($r!=null){
						$rr = mysqli_fetch_assoc($r);
						echo $rr['question'];
						
						echo '<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">看解答</a>';
						echo '<div class="collapse" id="collapseExample"><div class="well">';
						echo $rr['answer'];
						echo '</div></div>';
						
					}else{	
					
					# Question
					if($md['line1']!=null) {echo '<p>\('.$md['line1'].'\)</p>';}
					if($md['line2']!=null) {echo '<p>\('.$md['line2'].'\)</p>';}
					if($md['line3']!=null) {echo '<p>\('.$md['line3'].'\)</p>';}
					if($md['line4']!=null) {echo '<p>\('.$md['line4'].'\)</p>';}
					if($md['line5']!=null) {echo '<p>\('.$md['line5'].'\)</p>';}
					
					#image
					if($md['image']!=null){echo "<p><img src='img/".$md['image']."'></p><br>";}
					
					# Answer
					echo '<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">看解答</a>';
					echo '<div class="collapse" id="collapseExample"><div class="well">';
					if($md['answer1']!=null) {echo '<p>\('.$md['answer1'].'\)</p>';}
					if($md['answer2']!=null) {echo '<p>\('.$md['answer2'].'\)</p>';}
					if($md['answer3']!=null) {echo '<p>\('.$md['answer3'].'\)</p>';}
					echo '</div></div>';
					}
				?>
			</div>
		</div>
		
		
		<!--pagination-->		
		<nav aria-label="Page navigation">
		  <ul class="pagination">
		    <li>
		      <a href="practice.php?page=<?php echo $pageid-1;?>" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
		    <?php
		    	for ($x = 1; $x <= $rn['maxnum']; $x++){
		    		if($x == $pageid){
		    			echo '<li class="active"><a href="practice.php?pracid='.$pracid.'&page='.$x.'">'.$x.'</a></li>';
		    		}else{
		    			echo '<li><a href="practice.php?pracid='.$pracid.'&page='.$x.'">'.$x.'</a></li>';
					}
		    	}
		    ?>
		    <!--
		    <li><a href="practice.php?page=1">1</a></li>
		    <li><a href="practice.php?page=2">2</a></li>
		    <li><a href="practice.php?page=3">3</a></li>
		    <li><a href="practice.php?page=4">4</a></li>
		    <li><a href="practice.php?page=5">5</a></li>-->
		    <li>
		      <a href="practice.php?page=<?php if($pageid<$rn['maxnum']){echo $pageid+1;}else{echo $pageid;}?>" aria-label="Next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul>
		</nav>
		
			
		

	</div>
	<?php include('template/footer.php'); ?>
	</body>
</html>