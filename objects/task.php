<?php
class Task
{

    // подключение к базе данных и имя таблицы
    private $conn;
    private $table_name = "tasks";

    // свойства объекта
    public $id;
    public $name;
    public $mail;
    public $description;
    public $timestamp;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    // метод создания
    function create()
    {

        // запрос MySQL для вставки записей в таблицу БД
        // запрос
        $query = "INSERT INTO " . $this->table_name . "
    SET name=:name, mail=:mail, description=:description,
         created=:created";

        $stmt = $this->conn->prepare($query);

        // опубликованные значения
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->mail = htmlspecialchars(strip_tags($this->mail));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // получаем время создания записи
        $this->timestamp = date('Y-m-d H:i:s');

        // привязываем значения
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":mail", $this->mail);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":created", $this->timestamp);


        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

    function readAll($from_record_num, $records_per_page)
    {

        // запрос MySQL
        $query = "SELECT
                id, name, mail, description
            FROM
                " . $this->table_name . "
            ORDER BY
                name ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // используется для пагинации товаров
    public function countAll()
    {

        // запрос MySQL
        $query = "SELECT id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    function readOne()
    {

        // MySQL запрос
        $query = "SELECT name, mail, description
        FROM " . $this->table_name . "
        WHERE id = ?
        LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->mail = $row['mail'];
        $this->description = $row['description'];
    }

    function update()
    {

        // MySQL запрос для обновления записи
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                mail = :mail,
                description = :description
               
            WHERE
                id = :id";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->mail = htmlspecialchars(strip_tags($this->mail));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // привязка значений
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    function delete() {

                $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
var_dump($stmt);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}