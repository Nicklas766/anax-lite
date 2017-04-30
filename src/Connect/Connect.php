<?php

namespace nicklas\Connect;

use \PDO;

class Connect
{
    protected $db;

    /**
     * Constructor
     * @param $dsn string The dsn to the database-file
     * @return void
     */
    public function __construct()
    {


        // Studentserver
        $databaseConfig = [
            "dsn"      => "mysql:host=blu-ray.student.bth.se;dbname=nien16",
            "login"    => "nien16",
            "password" => "J9c84xWzsF5o",
            "options"  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
        ];

        // // Local development
        // $databaseConfig = [
        //     "dsn"      => "mysql:host=localhost;dbname=userprofiles;",
        //     "login"    => "user",
        //     "password" => "pass",
        //     "options"  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
        // ];

        try {
            $db = new PDO(...array_values($databaseConfig));
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $db;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            throw new PDOException("Could not connect to database, hiding details.");
        }
    }

    /**
     * Do INSERT/UPDATE/DELETE with optional parameters.
     *
     * @param string $sql   statement to execute
     * @param array  $param to match ? in statement
     *
     * @return PDOStatement
     */
    public function execute($sql, $param = [])
    {
        $sth = $this->db->prepare($sql);
        if (!$sth) {
            $this->statementException($sth, $sql, $param);
        }
        $status = $sth->execute($param);
        if (!$status) {
            $this->statementException($sth, $sql, $param);
        }
        return $sth;
    }
    /**
     * Adds user to the database
     * @param $user string The name of the user
     * @param $pass string The user's password
     * @return void
     */
    public function addUser($user, $pass, $authority)
    {
        $stmt = $this->db->prepare("INSERT into users (name, pass, authority) VALUES ('$user', '$pass', '$authority')");
        $stmt->execute();
    }
    // get res with fetchAll
    public function getAllRes($sql)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    // get res with one fetch
    public function getRes($sql)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    /**
     * Gets the hashed password from the database
     * @param $user string The user to get password from/for
     * @return string The hashed password
     */
    public function getHash($user)
    {
        $stmt = $this->db->prepare("SELECT pass FROM users WHERE name='$user'");
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res["pass"];
    }

    public function getInfo($user)
    {
        $stmt = $this->db->prepare("SELECT info, email, authority FROM users WHERE name='$user'");
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $returnValue = [$res["info"], $res["email"], $res["authority"]];

        return $returnValue;
    }

    public function edit($params, $user)
    {
        // Prepare SQL statement to UPDATE a row in the table
        $stmt = $this->db->prepare("UPDATE users SET info = ?, email = ? WHERE name='$user'");

        // Execute the SQL to Update
        $stmt->execute($params);
    }
    /**
     * Changes the password for a user
     * @param $user string The usr to change the password for
     * @param $pass string The password to change to
     * @return void
     */
    public function changePassword($user, $pass)
    {
        $stmt = $this->db->prepare("UPDATE users SET pass='$pass' WHERE name='$user'");
        $stmt->execute();
    }

    /**
     * Changes the password for a user
     * @param $user string The usr to change the password for
     * @param $pass string The password to change to
     * @return void
     */
    public function changePasswordId($id, $pass)
    {
        $stmt = $this->db->prepare("UPDATE users SET pass='$pass' WHERE id='$id'");
        $stmt->execute();
    }
    /**
     * Check if user exists in the database
     * @param $user string The user to search for
     * @return bool true if user exists, otherwise false
     */
    public function exists($user)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name='$user'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return !$row ? false : true;
    }
}
