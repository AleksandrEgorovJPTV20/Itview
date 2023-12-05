<!-- ошибка  -->

<?php 
	ob_start();
 ?>
<section id="about" class="about">
<div class="container" data-aos="fade-up">
  <header class="section-header" style="margin-top: 30%;">
	  <p>Error 404</p>
  </header>
</div>

</section>
<?php 
	$content = ob_get_clean(); 
	include "view/templates/layout.php";
?>