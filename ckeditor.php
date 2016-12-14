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

        
    </head>
    <body>
    	<div class="container">

	    	<form action="" method="post">
	    		<div class="form-group">
				    <label for="code">資料庫代碼</label>
				    <input type="text" class="form-control" name="code" id="code" value="<?php if(isset($_POST['code'])){echo $_POST['code']; }?>">
				</div>
	    		<label for="question">輸入題目</label>
	    		<textarea class="ckeditor" name="question">
	    			<?php if(isset($_POST['question'])){
	    				if(!isset($_POST['preview'])){
	    				}else{echo $_POST['question'];}
						} 
					?>
	    		</textarea>
	    		<label for="answer">輸入答案</label>
	    		<textarea class="ckeditor" name="answer">
	    			<?php if(isset($_POST['answer'])){
	    				if(!isset($_POST['preview'])){
	    				}else{echo $_POST['answer'];}
						} 
					?>
	    		</textarea>
			    <input type="submit" name="save" value="送出">
			    <input type="submit" name="preview" value="預覽">
			    <input type="submit" name="reset" value="重置">
	    	</form>
	
	    	<?php
				if(isset($_POST['question'])){
					$code = $_POST['code'];
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
						$dbc = mysqli_connect('182.50.133.77', 'jenginput', 'eric0517', 'insertdb') OR die('Error: '.mysqli_connect_error());
						
						$mathoutputq = mysqli_real_escape_string($dbc, $outputq);
						$mathoutputa = mysqli_real_escape_string($dbc, $outputa);
						
						mysqli_query($dbc, "SET NAMES utf8");
						$q = "INSERT INTO ".$code." (id, question, answer) VALUES ('$idName', '$mathoutputq', '$mathoutputa')";
						echo $q;
						$r = mysqli_query($dbc, $q);
					}		 
				}
			?>
		</div>
    </body>
</html>

