<?php
namespace App\Models;

trait LocalizableModel  {

    public function translation()
    {
        $class = get_class($this).'Translations';

        $model = $this->hasOne($class)->where('locale', app()->getLocale());
        return $model;
    }

    public function getLocaleField($name, $locale = false)
    {
        if($locale) {

            $locale = $this->translations->filter(function($record, $key ) use ($locale){

                return $record->locale == $locale;
            })->first();

            if($locale) {

                return optional($locale)->{$name};
            }
        }
        return optional($this->translation)->{$name};
    }

    public function translations()
    {
        $class = get_class($this).'Translations';
        return $this->hasMany($class);
    }


}
