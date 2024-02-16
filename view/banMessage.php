<!-- banMessage for users who got banned during their session  -->

<?php 
	ob_start();
 ?>
<section id="about" class="about">
<div class="container" data-aos="fade-up">
  <header class="section-header" style="margin-top: 20%;">
  	<p><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Konto peatatud' : 'Account suspended') ;?></p>
    <p style="font-size: 24px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Vabandust, teie konto on peatatud meie kogukonna juhendite rikkumise tõttu.' : 'Sorry, your account has been suspended due to a violation of our community guidelines.') ;?></p>
    <p style="font-size: 24px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Kui arvate, et see on eksitus või soovite otsust vaidlustada, võtke ühendust meie toe meeskonnaga.' : 'If you believe this is a mistake or would like to appeal the decision, please contact our support team.') ;?></p>
    <p style="font-size: 24px;"><?php echo (isset($_SESSION['language']) && $_SESSION['language'] == 'est' ? 'Aitäh mõistmise eest.' : 'Thank you for your understanding.') ;?></p>
  </header>
</div>

</section>
<?php 
	$content = ob_get_clean(); 
	include "view/templates/layout.php";
?>