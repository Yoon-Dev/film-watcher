<?php
namespace App\Utils;

class Contains
{
    public function contains(string $str, array $tab){
        $str = str_replace(' ', '', $str);
        if(!empty($tab)){
            $str_tab = implode(",", $tab);
                if (stripos($str_tab, $str) === false){

                    return true;
                }else{
                    return false;
                }
        }else{
            return true;
        }
    }
}

