<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;

class GenerateGame extends Controller
{

  /**
     * Create game
     *
     * @param  void
     * @return none
     */
    public static function game()
    {
        $getData = GenerateGame::paylines(); 
        echo "==============================="; 
        echo "\r\n"; 
        echo "==============================="; 
        echo "\r\n"; 
        $pair = []; 
        $filter = []; 
        $data = GenerateGame::board(); 
        $threeIndexs = GenerateGame::getConsecutiveIndex($data); 

        $winFormula =  GenerateGame::getListOfThreeWin($threeIndexs, $getData); 
        if (isset($winFormula)){
            echo json_encode($winFormula); 
        }
        
	}

    /**
     * Get three consecutive row number 
     * 
     * @param array  
     * @param array 
     * @return array 
     */
    public static function getListOfThreeWin($obj, $array2)
    {

        $winPair = []; 
       
        if ($obj->index == null) return $winPair; 
    
        $i = $obj->index;
        $winRow = $array2[$i]; 
        $x = "";
        for($j = 0; $j < count($winRow); ++$j){
                    $x .= $winRow[$j]." "; 
        }
        $winPair[$x] = $obj->sequence;  

        return $winPair; 
    }

    /**
     * Get the three consecutive symbols index
     *
     * @param  array 
     * @return array 
     */
    public static function getConsecutiveIndex($array){
        //$indexes = []; 
        $create  = (object)[];
        $create->index = null; 
        $create->sequence = null; 
         for ($i = 0 ; $i < count($array); ++$i){
             for ($j = 0; $j < 3 ; ++$j){
                 $sliceThree = array_slice($array[$i], $j, 3); 
                 if(count(array_unique($sliceThree)) == 1) {
                     $create->index = $i; 
                     $create->sequence = 3; 
                 } 
             } 
             for ($k = 0; $k < 2 ; ++$k){
                 $sliceFour = array_slice($array[$i], $k, 4); 
                  if(count(array_unique($sliceFour)) == 1) {
                        $create->index = $i; 
                        $create->sequence = 4; 
                }
             } 
            if (count(array_unique($array[$i])) == 1){
                    $create->index = $i; 
                    $create->sequence = 5; 
            }  
        }
        return $create;
    }

    /**
     * Create game bord with random symbol
     *
     * @param  void
     * @return array 
     */

    public static function board(){
         
         $row = range(0, 4); 
         $col = range(0, 2); 
         $bord = []; 
         $row1 = []; 
         $row2 = []; 
         $row3 = []; 
         $randomAlphabet = [9, 10, "J", "Q", "K", "A", "cat", "dog", "mon", "bir"]; 
         foreach($col as $c) {
              foreach($row as $r) {
                   switch($c){
                        case $c === 0:
                            $randindx = array_rand($randomAlphabet); 
                            $value1 = $randomAlphabet[$randindx]; 
                            array_push($row1, $value1); 
                            break; 
                        case $c === 1: 
                            $randindx = array_rand($randomAlphabet); 
                            $value2 = $randomAlphabet[$randindx]; 
                            array_push($row2, $value2); 
                            break; 
                        case $c === 2: 
                            $randindx = array_rand($randomAlphabet); 
                            $value3 = $randomAlphabet[$randindx]; 
                            array_push($row3, $value3); 
                            break; 
                        default:     
                    }
                 }
            echo "\r\n"; 
        }
         /***
         * Create random symbols bord
         */
        $arr = array_chunk($row2, 5, false); 
        array_push($bord, $arr[0], $arr[1], $row3); 
        for($i = 0; $i < count($bord); ++$i) {
            $x = ""; 
            for ($j = 0; $j < count($bord[$i]); ++$j) {
                  $x .= $bord[$i][$j] . " "; 
            }
           echo $x . "\r\n"; 
        }  
           
        return $bord; 

    }

    /**
     * Create game bored with arrry of number 
     *
     * @param  void
     * @return array 
     */
    public static function paylines () {
         $row = range(0, 4); 
         $col = range(0, 2); 
         $paylines = []; 
         $row2 = []; 
         $row3 = []; 
        $randomNumber = [0,1,2,3,4,5,6,7,8,9, 11, 12, 13, 14]; 
         foreach($col as $c) {
              foreach($row as $r) {
                   switch($c){
                        case $c === 0:
                            $randindx = array_rand($randomNumber); 
                            $rand1 = $randomNumber[$randindx]; 
                             array_push($row1, $rand1); 
                             break; 
                        case $c === 1: 
                            $randindx = array_rand($randomNumber); 
                            $rand2 = $randomNumber[$randindx]; 
                            array_push($row2, $rand2); 
                            break; 
                        case $c === 2: 
                            $randindx = array_rand($randomNumber); 
                            $rand3 = $randomNumber[$randindx]; 
                            array_push($row3, $rand3); 
                            break; 
                        default:     
                    }
                 }
            echo "\r\n"; 
        } 
        /***
         * Create random number bord
         */
        $arr = array_chunk($row2, 5, false); 
        array_push($paylines, $arr[0], $arr[1], $row3); 
        for($i = 0; $i < count($paylines); ++$i) {
            $x = ""; 
            for ($j = 0; $j < count($paylines[$i]); ++$j) {
                  $x .= $paylines[$i][$j] . " "; 
            }
             echo $x . "\r\n"; 
        }  
        return $paylines; 
    }


}



