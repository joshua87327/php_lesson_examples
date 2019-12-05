<?php
namespace App;
require_once 'DB.php';
class Rank
{
    var $team = array();
    var $score = array();
    var $ctfd = array();
    var $struts2 = array();
    var $aspx = array();
    var $wordpress = array();
    var $total = array();
    var $koh = array();
    public function __construct()
    {
        $this->team = $this->getTeam();
        $this->ctfd = $this->CalculateCtfdScore();
        $this->struts2 = $this->CalculateKohScore('struts2');
        $this->aspx = $this->CalculateKohScore('aspx');
        $this->wordpress = $this->CalculateKohScore('wordpress');
        $this->CalculateTotalScore();
        $this->CalculateTotalKohScore();
    } // constructor
    public function getCtfd(){
        return $this->ctfd;
    }
    public function getTotal(){
        return $this->total;
    }
    public function getStruts2(){
        return $this->struts2;
    }
    public function getAspx(){
        return $this->aspx;
    }
    public function getWordpress(){
        return $this->wordpress;
    }
    public function getKoh(){
        return $this->koh;
    }
    public static function array_sort($array, $on, $order=SORT_ASC){

        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
    public static function getTeam()
    {
        $team = [];
        $rows = DB::run('SELECT name FROM team')->fetchAll();
        foreach($rows as $row)
        {
            foreach($row as $key => $value)
            {
                array_push($team, $value);
            }
        }
        return $team;
    }
    public function CalculateKohScore($koh)
    {
        $output = [];
        for ($i=0;$i<10;$i++){
            $sql = DB::run('SELECT COUNT(name) FROM '.$koh.' WHERE name = ?', [$this->team[$i]])->fetch();
            $this->score[$i] = implode(',',$sql);
            $tmp = array(
                'name'  =>  $this->team[$i],
                'score' =>  $this->score[$i]*100
            );
            array_push($output, $tmp);
        }
        # $output = $this->array_sort($output, 'score', SORT_DESC);
        return $output;
    }
    public function CalculateCtfdScore(){
        $data = DB::run("SELECT name,score FROM ctfd")->fetchAll();
        # $output = $this->array_sort($data, 'score', SORT_DESC);
        return $data;
    }
    public function CalculateTotalScore(){
        for ($i=0;$i<10;$i++) {
            $this->total[$i]['name'] = $this->team[$i];
            $this->total[$i]['score'] = $this->ctfd[$i]['score'] + $this->struts2[$i]['score'] + $this->aspx[$i]['score'] +
                $this->wordpress[$i]['score'];
        }
    }
    public function CalculateTotalKohScore(){
        for ($i=0;$i<10;$i++) {
            $this->koh[$i]['name'] = $this->team[$i];
            $this->koh[$i]['score'] = $this->struts2[$i]['score'] + $this->aspx[$i]['score'] + $this->wordpress[$i]['score'];
        }
    }
}