<!--  Каталог спорта  -->
<?php
    ob_start();
?>

    <div class="col-lg-4 col-md-8 mx-auto">
        <h1 style="margin-top:100px; text-align:center" class="mb-4">Виды спорта</h1> <!-- Уменьшенный верхний отступ для заголовка -->
        <br>
        <br>
    </div>

<div class="container mb-4"> <!-- Уменьшенный отступ перед началом карточек -->
    <div class="row row-cols-1 row-cols-md-3 g-3">
        <?php
            foreach ($allcategories as $categories) {
                echo '<div style="display: flex; flex-wrap: wrap;"> <!-- Уменьшенная ширина карточек и добавлен отступ по бокам -->
                        <div class="card shadow-sm">
                            <div class="image-content">
                                <div class="card-image">
                                    <img src="'.$categories['image'].'" alt="" class="card-img mx-auto mb-3"> <!-- Добавлены классы для центрирования и увеличения отступа снизу -->
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-title" style="text-align: center;font-weight: bold;font-size: 1.2em;">'.$categories['title'].'</p>
                                <p class="card-text" style="text-align: center;">'.$categories['description'].'</p>
                                <div class="d-flex justify-content-center align-items-center">
                                </div>';
                if(isset($_SESSION['role']) && $_SESSION['role'] == "admin" or isset($_SESSION['role']) && $_SESSION['role'] == "manager"){
                    echo '<div style="display: flex; justify-content: center; width: 50%; margin: 10px auto;">
                    
                          </div>';
                }
                echo '</div>
                        </div>
                    </div>';
            }
        ?>
    </div>
</div>

<?php
    $content = ob_get_clean();
    include "view/templates/layout.php";
?>


