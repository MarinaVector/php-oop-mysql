<?php
// форма поиска
echo "<form role='search' action='search.php'>";
echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
$search_value = isset($search_term) ? "value='{$search_term}'" : "";
echo "<input type='text' class='form-control' placeholder='Search  ...' name='s' id='srch-term' required {$search_value} />";
echo "<div class='input-group-btn'>";
echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
echo "</div>";
echo "</div>";
echo "</form>";

// кнопка создания
echo "<div class='right-button-margin'>";
echo "<a href='create_task.php' class='btn btn-primary pull-right'>";
echo "<span class='glyphicon glyphicon-plus'></span>Create task";
echo "</a>";
echo "</div>";

// показать, если они есть
if ($total_rows > 0) {

    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>Task</th>";
    echo "<th>Mail</th>";
    echo "<th>Description</th>";
    echo "<th>Btn</th>";
    echo "</tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<td>{$name}</td>";
        echo "<td>{$mail}</td>";
        echo "<td>{$description}</td>";
        echo "<td>";


        /*
          echo "<a href='read_task.php?id={$id}' class='btn btn-primary left-margin'>";
          echo "<span class='glyphicon glyphicon-list'></span>Show";
          echo "</a>";


          echo "<a href='update_task.php?id={$id}' class='btn btn-info left-margin'>";
          echo "<span class='glyphicon glyphicon-edit'></span>Edit";
          echo "</a>";


          echo "<a delete-id={$id}' class='btn btn-danger delete-object'>";
          echo "<span class='glyphicon glyphicon-remove'></span>Delete";
          echo "</a>";

        */


          // ссылки для просмотра, редактирования и удаления товара
         echo "<a href='read_task.php?id={$id}' class='btn btn-primary left-margin'>
      <span class='glyphicon glyphicon-list'></span> Просмотр
  </a>
  
  <a href='update_task.php?id={$id}' class='btn btn-info left-margin'>
      <span class='glyphicon glyphicon-edit'></span> Редактировать
  </a>
  
  <a delete-id='{$id}' class='btn btn-danger delete-object'>
      <span class='glyphicon glyphicon-remove'></span> Удалить
  </a>";











        echo "</td>";

        echo "</tr>";

    }

    echo "</table>";


    include_once 'paging.php';
}

// сообщить пользователю, что  нет
else {
    echo "<div class='alert alert-danger'>Tasks not found.</div>";
}

