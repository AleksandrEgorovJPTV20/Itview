<!-- ошибка  -->

<?php 
	ob_start();
 ?>
 	<h2 style="text-align: center;">Error</h2>
	<div class="center" style="display: flex;">
		<img style="margin: auto;" src="images/404.png" >    
	</div> 

<?php 
	$content = ob_get_clean(); 
	include "view/templates/layout.php";
?>