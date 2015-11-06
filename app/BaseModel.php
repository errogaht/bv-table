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
                    $value = mb_strtolower($value, 'UTF-8');
                    break;
                case 'ucfirst':
                    $firstChar = mb_substr($value, 0, 1, 'UTF-8');
                    $then = mb_substr($value, 1, mb_strlen($value, 'UTF-8') - 1, 'UTF-8');
                    $value = mb_strtoupper($firstChar, 'UTF-8') . mb_strtolower($then, 'UTF-8');
                    break;
                default:
                    $value = parent::castAttribute($key, $value);
            }
        }

        return $value;
    }
}
