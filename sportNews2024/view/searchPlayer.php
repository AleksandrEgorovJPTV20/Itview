<!--  Страница вывода информации игрока по поиску -->
<?php
    ob_start();
?>  
<?php 
    if(isset($players) && $players) {
        echo '<div class="card-container" style="display: flex; flex-wrap: wrap; justify-content: center; margin-top: 60px;">';
        foreach($players as $player) {
            echo '<div class="card" style="margin: 10px; width: 320px;">';
            echo '  <div class="card-image">';
            echo '      <img src="'.$player['image'].'" alt="" class="card-img">';
            echo '  </div>';
            echo '  <div class="card-content">';
            echo '      <h2 class="name">'.$player['firstname']. ' ' . $player['lastname'].'</h2>';
            echo '      <p class="description" style="font-size: 16px;">'.$player['description'].'<br><br>Возраст: '.$player['age'].'</p>';
            // Проверяем, есть ли у пользователя права администратора или менеджера
            if(isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "manager")){
              echo '<div style="display: flex; justify-content: center; margin: 5px auto;">';
              echo '  <div style="margin-right: 5px;">';
              echo '    <button type="button" class="btn btn-success btn-sm edit-btn" data-toggle="modal" data-target="#editPlayersModal" data-players-id="'.$player['id'].'" data-playersfirstname="' . $player['firstname'] .'" data-playerslastname="' . $player['lastname'] .  '" data-playersdescription="' . $player['description'] . '" data-playersimage="' . $player['image'] . '" data-playersage="' . $player['age'] . '">Изменить</button>';
              echo '  </div>';
              echo '  <div>';
              echo '    <button type="button" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deletePlayersModal" data-players-id="' . $player['id'] .'" >Удалить</button>';
              echo '  </div>';
              echo '</div>';
          }
            echo '  </div>';
            echo '</div>';
        }        
        echo '</div>';
    } else {
        echo '<div><h2 style="text-align: center;">Нет данных</h2></div>';
    }
?>


<div class="modal fade" id="editPlayersModal" tabindex="-1" role="dialog" aria-labelledby="editPlayersModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPlayersModalLabel">Изменение игрока</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Форма для изменения игрока -->

        <form class="form-signin" action="editplayersresult?<?php echo $searchQuery; ?>" method="POST">
          <input type="hidden" name="playersId" value="">
          <div class="form-group">
            <label for="playersFirstname" class="control-label">Введите имя</label>
            <input type="text" class="form-control" id="playersFirstname" name="playersFirstname" required>
          </div>
          <div class="form-group">
            <label for="playersLastname" class="control-label">Введите фамилию</label>
            <input type="text" class="form-control" id="playersLastname" name="playersLastname" required>
          </div>
          <div class="form-group">
            <label for="playersAge" class="control-label">Введите возраст</label>
            <input type="text" class="form-control" id="playersAge" name="playersAge" required>
          </div>
          <div class="form-group">
            <label for="playersDescription" class="control-label">Описание игрока</label>
            <input type="text" class="form-control" id="playersDescription" name="playersDescription" required>
          </div>
          <div class="form-group">
            <label for="playersImage" class="control-label">Ссылка на изображение</label>
            <input type="text" class="form-control" id="playersImage" name="playersImage">
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
          <button name="send" type="submit" class="btn btn-primary">Изменить игрока</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deletePlayersModal" tabindex="-1" role="dialog" aria-labelledby="deletePlayersModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePlayersModalLabel">Удаление игрока</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Вы действительно хотите удалить игрока?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        <form action="deleteplayersbycategoriesresult?<?php echo $searchQuery; ?>" method="POST">
          <input type="hidden" name="playersId" value="">
          <button name="send" type="submit" class="btn btn-danger">Да</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

  $('.edit-btn').on('click', function() {
      var playersId = $(this).data('players-id');
      var playersFirstname = $(this).data('playersfirstname');
      var playersLastname = $(this).data('playerslastname');
      var playersDescription = $(this).data('playersdescription');
      var playersImage = $(this).data('playersimage');
      var playersAge = $(this).data('playersage');

      $('#editPlayersModal input[name="playersId"]').val(playersId);
      $('#editPlayersModal input[name="playersFirstname"]').val(playersFirstname);
      $('#editPlayersModal input[name="playersLastname"]').val(playersLastname);
      $('#editPlayersModal input[name="playersDescription"]').val(playersDescription);
      $('#editPlayersModal input[name="playersImage"]').val(playersImage);
      $('#editPlayersModal input[name="playersAge"]').val(playersAge);

  });

  $('.delete-btn').on('click', function() {
      var playersId = $(this).data('players-id');

      $('#deletePlayersModal input[name="playersId"]').val(playersId);

  });
  
</script>

<?php
    $content = ob_get_clean();
    include "view/templates/layout.php";
?>
