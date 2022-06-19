<?php


namespace App\Models\Traits;


use Illuminate\Support\Facades\App;

trait Translatable
{
    public function __($fieldName){
        if(App::getLocale()){
            $fieldName .= '_' . App::getLocale();
        }
        else{
            $fieldName .= '_ru';
        }
//        dd($fieldName);
        return $this->$fieldName;
    }
}
