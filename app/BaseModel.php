<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        $types = explode('|', $this->getCastType($key));
        foreach ($types as $type) {
            switch ($type) {
                case 'trim':
                    $value = trim($value);
                    break;
                case 'lower':
                    $value = strtolower($value);
                    break;
                default:
                    $value = parent::castAttribute($key, $value);
            }
        }

        return $value;
    }
}
