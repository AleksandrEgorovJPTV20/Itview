<?php
require_once 'vendor/autoload.php'; // Load Composer's autoloader

use Dotenv\Dotenv;
class database {

    public $conn;
    private $host;
    private $user;
    private $password;
    private $baseName;

    function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->baseName = $_ENV['DB_NAME'];     
        $this->connect(); //метод соединения с базой данных
    }

    function __destruct() {
        $this->disconnect();
    }

    function connect() {
        try {
            $this->conn = new PDO(
                    'mysql:host='.$this->host.''
                    .';dbname='.$this->baseName.'',
                    $this->user, 
                    $this->password, 
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
					//$this-> conn - идентификатор базы данных
        } catch (Exception $e) {
            die('Connection failed : '.$e->getMessage());//вывод об ошибке соединения
        }

        return $this->conn;//$this-> conn - идентификатор базы данных
    }
    

    function disconnect() {
        if ($this->conn) {// автомтическое выключение/подключение к БД
            $this->conn = null;
        }
    }
//запрос SELECT на получение одной записи по условию
    function getOne($query) {
		try{
			$result = $this->conn->prepare($query); // метод подготовки запроса
			$result->execute(); // метод выполнение запроса		
			$result->setFetchMode(PDO::FETCH_ASSOC);// выборка данных по названию полей
			$response = $result->fetch();// одна строка - fetch() из таблицы после запроса
				// цикл не требуется
			return $response;
            
        } catch (Exception $ex) {            
            echo "Error:".$ex->getMessage();
        } 
    }
//запрос SELECT на получение списка- массив записей
    function getAll($query) {         
		try{
            $result = $this->conn->prepare($query); // метод подготовки запроса
			$result->execute(); // метод выполнение запроса
			
			$result->setFetchMode(PDO::FETCH_ASSOC);// выборка данных по названию полей
			$response = $result->fetchAll();// на выходе таблица данных (виртуальная) fetchAll()
			return $response;
            
        } catch (Exception $ex) {            
            echo "Error:".$ex->getMessage();
        } 
    }
 //----------------------- ЗАПРОСЫ ДЕЙСТВИЯ -----------------------------
    // ДЛЯ INSERT, UPDATE, DELETE
    //http://php.net/manual/ru/pdo.exec.php
    //PDO::exec — Запускает SQL запрос на выполнение и возвращает количество строк, задействованных в ходе его выполнения
    //запросы действия INSERT   UPDATE    DELETE
    function executeRun($query) {       
		try{
            $response=  $this->conn->exec($query);
            return $response;
            
        } catch (Exception $ex) {            
            echo "Error:".$ex->getMessage();
        }   
    }

}//end class
?>