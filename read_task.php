<?php

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: отсутствует ID.');

include_once 'config/database.php';
include_once 'objects/task.php';

$database = new Database();
$db = $database->getConnection();

$task = new Task($db);

$task->id = $id;

// получаем информацию о товаре
$task->readOne();
$page_title = "Task page";

require_once "layout_header.php";
?>

<!-- ссылка на все товары -->
<div class='right-button-margin'>
    <a href='index.php' class='btn btn-primary pull-right'>
        <span class='glyphicon glyphicon-list'></span> Просмотр всех
    </a>
</div>

<!-- HTML-таблица для отображения информации -->
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Name</td>
        <td><?php echo $task->name; ?></td>
    </tr>
    <tr>
        <td>Mail</td>
        <td><?php echo $task->mail; ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?php echo $task->description; ?></td>
    </tr>


</table>

<?php // подвал
require_once "layout_footer.php";
?>
