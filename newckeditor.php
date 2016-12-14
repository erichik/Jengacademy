<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CKEditor</title>
        <!--<script src="//cdn.ckeditor.com/4.6.0/full/ckeditor.js"></script>-->
        <script src="ckeditor/ckeditor.js"></script>
        <script type="text/javascript" async
		  src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
		</script>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include 'config/js.php'; ?>
		<?php include 'config/css.php'; ?>
		<?php include 'functions/mathjaxstr.php'; ?>
		<?php include 'config/setup.php'; ?>
		<!--<style>
			#editor {
			    position: fixed;
			    top: 0;
  				right: 0;
			} 
		</style>-->

        
    </head>
    <body>
    	
    	<div class="row">
    		
    		<div class="col-md-6">
    			<div class="list-group">
					<?php
						//if(isset($_POST['save'])){
			    			$tablename = $_GET['code'];
		
							$q = "SELECT * FROM $tablename ORDER BY orderid ASC";
							mysqli_query($dbc, "SET NAMES utf8");					
							$r = mysqli_query($dbc, $q);
							$i = 1;
							
							while($row = mysqli_fetch_assoc($r)) {
								//$pre = substr($row['question'], 0, 200)."\)</p>";
								?>
								<a href='newckeditor.php?code=<?php echo $tablename; ?>&orderid=<?php echo $i; ?>' class='list-group-item'>
									<?php echo $row['question']; ?>
								</a>
							<?php $i++; } 
						//}
					?>
					
				</div>
    		</div>
    		<div class="col-md-6" id="editor">
    			<?php
    				if(isset($_GET['orderid'])){
    					$orderId = $_GET['orderid'];
	    				$q = "SELECT question, answer FROM $tablename WHERE orderid = $orderId";				
						$r = mysqli_query($dbc, $q);
						$editRow = mysqli_fetch_assoc($r);
						$editQ = reverseStr($editRow['question']);
						$editA = reverseStr($editRow['answer']);
					}
    			?>
    			<form action="" method="post">
	    		
		    		<label for="question">輸入題目</label>
		    		<textarea class="ckeditor" name="question">
		    			<?php 
		    				if(isset($_GET['orderid'])and!isset($_POST['preview'])){
			    				echo $editQ;
							}
		    				if(isset($_POST['question'])){
			    				if(!isset($_POST['preview'])){
			    					
			    				}else{
			    					echo $_POST['question'];
			    				}
							} 
						?>
		    		</textarea>
		    		
		    		<label for="answer">輸入答案</label>
		    		<textarea class="ckeditor" name="answer">
		    			<?php 
		    				if(isset($_GET['orderid'])and!isset($_POST['preview'])){
			    				echo $editA;
							}
		    				if(isset($_POST['answer'])){
			    				if(!isset($_POST['preview'])){
			    					
			    				}else{
			    					echo $_POST['answer'];
								}
							} 
						?>
		    		</textarea>
				    <input class="btn btn-default" type="submit" name="save" value="送出">
				    <input class="btn btn-default" type="submit" name="preview" value="預覽">
				    <a class="btn btn-default" href="newckeditor.php?code=<?php echo $tablename; ?>" role="button">重置</a>
	    		</form>
	
	    	<?php
				if(isset($_POST['question'])){
					$code = $_GET['orderid'];
					$inputq = $_POST['question'];
					$inputa = $_POST['answer'];
					
					//產生id
					$idTime = time() % 100000;
					$idRandom = rand(100, 999);
					$idName = $idTime.$idRandom;
	
					if(!isset($_POST['reset'])){
							
						?>
						<hr>	
						<div class="panel panel-info">
							<div class="panel-heading">
							    <h3 class="panel-title">練習</h3>
							</div>
							<div class="panel-body">
						<?php	
						$outputq = mathjaxstr($inputq);
						$outputa = mathjaxstr($inputa);
						
						#question preview	
						echo $outputq;
						
						# Answer preview
						echo '<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">看解答</a>';
						echo '<div class="collapse" id="collapseExample"><div class="well">';
						echo $outputa;
						echo '</div></div>';
						
						?>
							</div>
						</div>
						
						<?php
						
					}
					
					if(isset($_POST['save'])){	
						//$dbc = mysqli_connect('182.50.133.77', 'jenginput', 'eric0517', 'insertdb') OR die('Error: '.mysqli_connect_error());
						$mathoutputq = mysqli_real_escape_string($dbc, $outputq);
						$mathoutputa = mysqli_real_escape_string($dbc, $outputa);
						
						if(!isset($_GET['orderid'])){
							//$mathoutputq = mysqli_real_escape_string($dbc, $outputq);
							//$mathoutputa = mysqli_real_escape_string($dbc, $outputa);
							
							
							$q = "INSERT INTO ".$code." (id, question, answer) VALUES ('$idName', '$mathoutputq', '$mathoutputa')";
							//$r = mysqli_query($dbc, $q);
						}else{
							mysqli_query($dbc, "SET NAMES utf8");
							$q = "UPDATE ".$tablename." SET question = ".$mathoutputq.", answer = ".$mathoutputa." WHERE orderid = ".$orderId;
							echo $q;
							$r = mysqli_query($dbc, $q);
							echo mysqli_num_rows($r);
						}		 
					}
						
				}
			?>
    		</div>
    	</div>
    </body>
</html>

