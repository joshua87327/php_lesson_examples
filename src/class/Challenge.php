<?php
namespace App;
require_once 'DB.php';
class Challenge
{
    var $tablename;         // table name
    var $id;
    var $name;
    var $description;
    var $max_attempts;
    var $value;
    var $type;
    var $state;         // list of fields in this table
    var $errors;            // array of error messages

    public function __construct()
    {
    } // constructor

    public function display($id)
    {
        $row = DB::run("SELECT * FROM challenges WHERE id=?", [$id])->fetch();
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->max_attempts = $row['max_attempts'];
        $this->value = $row['value'];
        $this->type = $row['type'];
        $this->state = $row['state'];
    }
    public static function fetchAll(){
        $data = DB::run("SELECT * FROM challenges")->fetchAll();
        $tmp = array();
        foreach ($data as $row){
            $tmp[$row['category']][] = $row;
        }
        $output = array();
        foreach ($tmp as $field => $content){
            $output[] = array(
                'category' => $field,
                'contents' => $content
            );
        }
        return $output;
    }
}