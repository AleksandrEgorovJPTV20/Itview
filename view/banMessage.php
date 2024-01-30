<!-- banMessage for users who got banned during their session  -->

<?php 
	ob_start();
 ?>
<section id="about" class="about">
<div class="container" data-aos="fade-up">
  <header class="section-header" style="margin-top: 20%;">
  	<p>Account Suspended</p>
    <p style="font-size: 24px;">Sorry, your account has been suspended due to a violation of our community guidelines.</p>
    <p style="font-size: 24px;">If you believe this is a mistake or would like to appeal the decision, please contact our support team.</p>
    <p style="font-size: 24px;">Thank you for your understanding.</p>
  </header>
</div>

</section>
<?php 
	$content = ob_get_clean(); 
	include "view/templates/layout.php";
?>