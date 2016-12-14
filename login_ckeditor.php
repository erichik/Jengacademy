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
		<?php include 'config/setup.php'; ?>
		<style>

		</style>

        
    </head>
    <body>
    	<div class="container">
	    	<form action="newckeditor.php" method="get">
		    		<div class="form-group">
					    <label for="code">資料庫代碼</label>
					    <input type="text" class="form-control" name="code" id="code" value="">
					</div>
					<input type="submit" name="save" value="送出">
			</form>
		</div>
    	
    	
    </body>
</html>

