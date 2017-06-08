<?php
/**
 * Created by PhpStorm.
 * User: Gaurav
 * Date: 7/27/2015
 * Time: 1:29 PM
 */




class Table
{
    public $values = array();
    private $maxRow = -1;
    private $maxColumn =-1;
    public $firstRowTr = false;


    public function Table(){



    }
    public function display(){
        for($i = 0; $i <= $this->maxRow; $i ++){
            if($i == 0){
                echo "<thead>";
            }if($i ==1){
                echo "<tbody>";
            }
            echo "<tr>";

            if($i == 0 && $this->firstRowTr){
                for ($j = 0; $j <= $this->maxColumn; $j++) {
                    if (isset($this->values[$i][$j]))
                        echo "<th>" . $this->values[$i][$j] . "</th>";
                    else
                        echo "<th></th>";
                }
                echo "</tr>";
            }else {
                for ($j = 0; $j <= $this->maxColumn; $j++) {
                    if (isset($this->values[$i][$j]))
                        echo "<td>" . $this->values[$i][$j] . "</td>";
                    else
                        echo "<td></td>";
                }
                echo "</tr>";
            }
            if($i == 0){
                echo "</thead>";
            }
        }
        echo "</tbody>";
    }
    public function set($row, $col, $value){
        if($row > $this->maxRow) $this->maxRow = $row;
        if($col > $this->maxColumn) $this->maxColumn = $col;
        if(!isset($this->values[$row])){
            $this->values[$row] = array($col => $value);
        }else{
            $this->values[$row][$col] = $value;

        }

    }
}