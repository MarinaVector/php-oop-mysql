<?php
// проверим, было ли получено значение в $_POST
if ($_POST) {

    // подключаем файлы для работы с базой данных и файлы с объектами
    include_once 'config/database.php';
    include_once 'objects/task.php';

    // получаем соединение с базой данных
    $database = new Database();
    $db = $database->getConnection();

    // подготавливаем объект
    $task = new Task($db);

    // устанавливаем ID для удаления
    $task->id = $_POST['object_id'];

    // удаляем
    if ($task->delete()) {
        echo "был удалён.";
    }
    // если невозможно удалить
    else {
        echo "Невозможно удалить";
    }
}

