<!-- Register -->
<?php
	ob_start();
?>
<section id="forum" class="about" style="margin-top: 10%;">
    <div class="container" data-aos="fade-up">
        <div class="row gx-0" style="display: flex; justify-content: center; flex-wrap: wrap;">
			<div class="col-lg-6 d-flex flex-column justify-content-center" style="background: purple; width: 100%; height: 100px;" data-aos="fade-up" data-aos-delay="200">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" style="background: blue; width: 100%; height: 100px;" data-aos-delay="200">
            <?php
                        foreach ($alltopics as $topic){
                            echo '<div>'.$topic['name'].'</div>';
                        }
                    ?>
            </div>
        </div>
        <div class="pagination">
    <?php
    //Pages amount
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='/forum?page=$i'>$i</a> ";
    }
    ?>
</div>
    </div>
</section>

<?php
	$content = ob_get_clean();
	include "view/templates/layout.php";
?>		