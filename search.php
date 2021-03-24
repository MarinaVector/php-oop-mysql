<?php
// содержит переменные пагинации
include_once 'config/core.php';

// для подключения к БД и файлы с объектами
include_once 'config/database.php';
include_once 'objects/task.php';

// создание экземпляра класса базы данных и товара
$database = new Database();
$db = $database->getConnection();

$task = new Task($db);

// получение поискового запроса
$search_term = isset($_GET['s']) ? $_GET['s'] : '';

$page_title = "You search \"{$search_term}\"";
require_once "layout_header.php";

// запрос
$stmt = $task->search($search_term, $from_record_num, $records_per_page);

// указываем страницу, на которой используется пагинация
$page_url = "search.php?s={$search_term}&";

// подсчитываем общее количество строк - используется для разбивки на страницы
$total_rows = $task->countAll_BySearch($search_term);

// шаблон для отображения списка
include_once "read_template.php";

require_once "layout_footer.php";

