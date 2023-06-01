<?php

/*abstract class Conexao {

    private static $instance;

    /**
     * 
     * @return PDO
     
    public static function getInstance() {
        try {
            if (!isset(self::$instance)) {
                self::$instance = new PDO("mysql:host=localhost;dbname=db_login;charset=UTF8","root","");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$instance;
        } catch (PDOException $exc) {
            echo "Erro ao conectar o banco de dados :" . $exc->getMessage();
        }
    }

}*/

interface DatabaseAdapter {
    public function connect();
}

class MySQLAdapter implements DatabaseAdapter {
    private $host;
    private $dbname;
    private $username;
    private $password;

    public function __construct($host, $dbname, $username, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=UTF8";
        $connection = new PDO($dsn, $this->username, $this->password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }
}

class PostgreSQLAdapter implements DatabaseAdapter {
    private $host;
    private $dbname;
    private $username;
    private $password;

    public function __construct($host, $dbname, $username, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect() {
        $dsn = "pgsql:host={$this->host};dbname={$this->dbname}";
        $connection = new PDO($dsn, $this->username, $this->password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }
}

class ConexaoAdapter implements DatabaseAdapter {
    private $adapter;

    public function __construct(DatabaseAdapter $adapter) {
        $this->adapter = $adapter;
    }

    public function connect() {
        return $this->adapter->connect();
    }
}

class Conexao {
    private static $instance;

    /**
     * 
     * @return PDO
     */
    public static function getInstance() {
        try {
            if (!isset(self::$instance)) {
                $databaseType = 'mysql'; // or 'pgsql' for PostgreSQL
                $host = 'localhost';
                $dbname = 'db_login';
                $username = 'root'; // MySQL username or PostgreSQL username
                $password = ''; // MySQL password or PostgreSQL password

                $adapter = null;
                switch ($databaseType) {
                    case 'mysql':
                        $adapter = new MySQLAdapter($host, $dbname, $username, $password);
                        break;
                    case 'pgsql':
                        $adapter = new PostgreSQLAdapter($host, $dbname, $username, $password);
                        break;
                    default:
                        throw new Exception("Unsupported database type: {$databaseType}");
                }

                $conexaoAdapter = new ConexaoAdapter($adapter);
                self::$instance = $conexaoAdapter->connect();
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$instance;
        } catch (PDOException $exc) {
            echo "Error connecting to the database: " . $exc->getMessage();
        }
    }
}


?>
