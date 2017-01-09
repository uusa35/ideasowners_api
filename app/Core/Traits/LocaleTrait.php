<?php
namespace App\Core\Traits;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

trait LocaleTrait
{

    /**
     * @param $name
     * @return localized string
     * Return Localized String
     */
    public function __get($name)
    {
        if (in_array($name, array_values($this->localeStrings))) {

            $locale = App::getLocale();

            if ($locale == 'en') {

                if (!is_null($this->{$name . '_en'})) {

                    return $this->{$name . '_en'};

                }

                return $this->{$name . '_ar'};

            } else {

                if (!is_null($this->{$name . '_ar'})) {

                    return $this->{$name . '_ar'};

                }

                return $this->{$name . '_en'};
            }
        }

        return parent::__get($name);
    }

    public static function getPossbileStatuses(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM pages WHERE Field = "type"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
} 