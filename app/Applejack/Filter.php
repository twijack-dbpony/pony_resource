<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/23/2018 AD
 * Time: 4:02 PM
 */
namespace App\Applejack;

class Filter{

    private $filter_data;

    public function __construct($filter_data)
    {
        $this->filter_data = $filter_data;
    }

    public function filter_done(){
        if(!is_array($this->filter_data)){
            $this->filter_data=$this->filter_this_junk($this->filter_data);
        }else{
            foreach($this->filter_data as $aj => $ts){
                //twijack best cp ever!
                $this->filter_data[$aj]=$this->filter_this_junk($ts);
            }
        }
        return $this->filter_data;
    }

    private function filter_this_junk($fitler){
        $fitler=filter_var(strip_tags($fitler),FILTER_SANITIZE_STRING);
        $filter_list=config('filter.filter');
        $filter=str_replace($filter_list,'',$fitler);
        return $filter;
    }
}