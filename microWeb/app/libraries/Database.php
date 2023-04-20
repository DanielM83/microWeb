<?php

/**
 * PDO Database Class
 * Connect to database
 * Create prepared statements
 * Bind values
 * return rows and results
 */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbName = DB_NAME;

    private $dbHandler;
    private $stmnt;
    private $error;

    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];

        try {
            $this->dbHandler = new PDO($dsn, $this->user, $this->pass, $options);
            
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            pre($this->error);
        }
    }

    public function query($sql) {
        $this->stmnt = $this->dbHandler->prepare($sql);
    }

    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                
                default:
                $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmnt->bindValue($param, $value, $type);
    }

    public function execute() {
        $this->stmnt->execute();
    }

    public function resultSet() {
        $this->execute();
        return $this->stmnt->fetchAll();
    }

    public function single() {
        $this->execute();
        return $this->stmnt->fetch();
    }

    public function rowCount() {
        return $this->stmnt->rowCount();
    }
}
