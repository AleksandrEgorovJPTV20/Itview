<!-- Страница вывода новостей по категориям -->
<?php
    ob_start();
?>


<?php 
    if(isset($newsByCategories) && $newsByCategories) {
        echo '<div>
        <h1 style="text-align: center; margin-top: 70px;">'.$category['title'].'</h1>
        <hr style="width: 70%; margin-left: 15%;"></hr>';
        echo '<div class="card-container" style="display: flex; flex-wrap: wrap; justify-content: center; margin-top: 60px;">';
        foreach($newsByCategories as $news) {
            echo '<div class="card" style="margin: 10px; width: 400px;">';
            echo '  <div class="card-image">';
            echo '      <img src="'.$news['image'].'" alt="" class="card-img">';
            echo '  </div>';
            echo '  <div class="card-content">';
            echo '      <h2 class="name">'.$news['title']. '</h2>';
            echo '      <p class="description" style="font-size: 16px;">'.$news['description'].'</p>';
            echo '      <div style="margin-top: 0px;">';
            echo '          <a href="#" class="btn btn-primary btn-sm">Подробнее</a>'; 
            echo '      </div>'; 
            if(isset($_SESSION['role']) && ($_SESSION['role'] == "admin" or $_SESSION['role'] == "manager")){
                echo '<div style="margin-top: 10px;">
                        <button type="button" class="btn btn-success btn-sm edit-btn" data-toggle="modal" data-target="#editNewsModal" data-news-id="' . $news['id'] .'" data-title="' . $news['title'] .'" data-description="' . $news['description'] .  '"data-image="' . $news['image'] . '">Изменить</button>
                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteNewsModal" data-news-id="' . $news['id'] .'" >Удалить</button>

                    </div>';
            }
            echo '  </div>';
            echo '</div>';
        }
        echo '</div>';
       echo'</div>';
    } else {
        echo '<div><h2 style="text-align: center;">Нет данных</h2></div>';
    }
?>
 <div class="modal fade" id="editNewsModal" tabindex="-1" role="dialog" aria-labelledby="editNewsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editNewsModalLabel">Редактирование новости</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-signin" action="editnewsbycategoriesresult?<?php echo $category['id']; ?>" method="POST">
        <input type="hidden" name="newsId" value="">
          <div class="form-group">
            <label for="title">Заголовок:</label>
            <input type="text" class="form-control" id="title" name="title" value="">
          </div>
          <div class="form-group">
            <label for="description">Описание:</label>
            <input type="text" class="form-control" id="description" name="description" value="">
          </div>
          <div class="form-group">
            <label for="image">Ссылка на изображение:</label>
            <input type="text" class="form-control" id="image" name="image" value="">
          </div>
          <div class="form-group">
            <label for="categoriesSelect">Выберите категорию:</label>
            <select name="categoriesSelect" class="form-control" id="categoriesSelect">
              <?php
                foreach ($allcategories as $categories) {
                  echo '<option value="'.$categories['id'].'" >'.$categories['title'].'</option>';
                  }
              ?>
            </select>   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteNewsModal" tabindex="-1" role="dialog" aria-labelledby="deleteNewsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteNewsModalLabel">Удаление новости</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Вы действительно хотите удалить новость?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        <form action="deletenewsbycategoriesresult?<?php echo $category['id']; ?>" method="POST">
          <input type="hidden" name="newsId" value="">
          <button name="send" type="submit" class="btn btn-danger">Да</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $('.edit-btn').on('click', function() {
      var newsId = $(this).data('news-id');
      var title = $(this).data('title');
      var description = $(this).data('description');
      var image = $(this).data('image');

      $('#editNewsModal input[name="newsId"]').val(newsId);
      $('#editNewsModal input[name="title"]').val(title);
      $('#editNewsModal input[name="description"]').val(description);
      $('#editNewsModal input[name="image"]').val(image);

  });

  $('.delete-btn').on('click', function() {
      var newsId = $(this).data('news-id');

      $('#deleteNewsModal input[name="newsId"]').val(newsId);

  });
</script>

<?php
    $content = ob_get_clean();
    include "view/templates/layout.php";
?>



