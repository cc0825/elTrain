<?php
namespace Phppot;

use Phppot\DataSource;

class UserModel
{

    private $conn;

    function __construct()
    {
        require_once 'DataSource.php';
        $this->conn = new DataSource();
    }

    function getAllTrains()
    {
        $sqlSelect = "SELECT * FROM trains";
        $result = $this->conn->select($sqlSelect);
        return $result;
    }

    function readTrainlines()
    {
        $fileName = $_FILES["file"]["tmp_name"];
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($fileName, "r");
            $importCount = 0;
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                if (! empty($column) && is_array($column)) {
                    if ($this->hasEmptyRow($column)) {
                        continue;
                    }
                    if (isset($column[1], $column[3], $column[4])) {
                        $train_line = $column[1];
                        $route_name = $column[2];
                        $run_number = $column[3];
                        $operator_id = $column[4];
                        $insertId = $this->insertTrain($train_line, $route_name, $run_number, $operator_id);
                        if (! empty($insertId)) {
                            $output["type"] = "success";
                            $output["message"] = "Import completed.";
                            $importCount ++;
                        }
                    }
                } else {
                    $output["type"] = "error";
                    $output["message"] = "Problem in importing data.";
                }
            }
            if ($importCount == 0) {
                $output["type"] = "error";
                $output["message"] = "Duplicate data found.";
            }
            return $output;
        }
    }

    function hasEmptyRow(array $column)
    {
        $columnCount = count($column);
        $isEmpty = true;
        for ($i = 0; $i < $columnCount; $i ++) {
            if (! empty($column[$i]) || $column[$i] !== '') {
                $isEmpty = false;
            }
        }
        return $isEmpty;
    }

    function insertTrain($train_line, $route_name, $operator_id, $run_number)
    {
        $sql = "SELECT train_line FROM trains WHERE train_line = ?";
        $paramType = "s";
        $paramArray = array(
            $train_line
        );
        $result = $this->conn->select($sql, $paramType, $paramArray);
        $insertTrain = 0;
        if (empty($result)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT into trains (train_line,route_name,run_number,operator_id)
                       values (?,?,?,?)";
            $paramType = "ssss";
            $paramArray = array(
                $train_line,
                $route_name,
                $run_number,
                $operator_id
            );
            $insertTrain = $this->conn->insert($sql, $paramType, $paramArray);
        }
        return $insertTrain;
    }
}
?>