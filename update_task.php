<?php
// получаем ID
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: отсутствует ID.');

// подключаем файлы для работы с базой данных и файлы с объектами
include_once 'config/database.php';
include_once 'objects/task.php';

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// подготавливаем объекты
$task = new Task($db);

$task->id = $id;

// получаем информацию о редактируемом т
$task->readOne();

// установка заголовка страницы
$page_title = "Обновление";

include_once "layout_header.php";
?>

<div class='right-button-margin'>
    <a href='index.php' class='btn btn-default pull-right'>View all tasks</a>
</div>

<?php
// если форма была отправлена (submit)
if ($_POST) {

    // устанавливаем значения свойствам
    $task->name = $_POST['name'];
    $task->mail = $_POST['mail'];
    $task->description = $_POST['description'];

    // обновление
    if ($task->update()) {
        echo "<div class='alert alert-success alert-dismissable'>";
        echo "был обновлён.";
        echo "</div>";
    }

    // если не удается обновить, сообщим об этом пользователю
    else {
        echo "<div class='alert alert-danger alert-dismissable'>";
        echo "Невозможно обновить.";
        echo "</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $task->name; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Mail</td>
            <td><input type='text' name='mail' value='<?php echo $task->mail; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'><?php echo $task->description; ?></textarea></td>
        </tr>


        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">CHANGE</button>
            </td>
        </tr>

    </table>
</form>

<?php
require_once "layout_footer.php";
?>
