<?php
// подключим файлы, необходимые для подключения к базе данных и файлы с объектами
include_once 'config/database.php';
include_once 'objects/task.php';


// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// создадим экземпляры классов Product и Category
$task = new Task($db);

$page_title = "Создание";

require_once "layout_header.php";

?>

    <div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Просмотр всех</a>
    </div>

<?php
// если форма была отправлена
if ($_POST) {

    // установим значения свойствам
    $task->name = $_POST['name'];
    $task->mail = $_POST['mail'];
    $task->description = $_POST['description'];

    // создание
    if ($task->create()) {
        // пытаемся загрузить отправленный файл

        echo "<div class='alert alert-success'>был успешно создан.</div>";
    }

    // если не удается создать, сообщим об этом пользователю
    else {
        echo "<div class='alert alert-danger'>Невозможно создать.</div>";
    }
}
?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
          method="post"
          enctype="multipart/form-data">

        <table class='table table-hover table-responsive table-bordered'>

            <tr>
                <td>Name</td>
                <td><input type='text' name='name' class='form-control' /></td>
            </tr>

            <tr>
                <td>@mail</td>
                <td><input type='text' name='mail' class='form-control' /></td>
            </tr>

            <tr>
                <td>Description</td>
                <td><textarea name='description' class='form-control'></textarea></td>
            </tr>

            <tr>


            </tr>


            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">CREATE TASK</button>
                </td>
            </tr>

        </table>
    </form>

<?php
require_once "layout_footer.php";
?>