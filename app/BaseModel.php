<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * @var array
     */
    protected $set_mutators = [];


    /**
     * Преобразование на запись
     *
     * @param string $key
     * @param mixed  $value
     * @return $this|void
     */
    public function setAttribute($key, $value)
    {
        if (isset($this->set_mutators[$key])) {
            $types = explode('|', $this->set_mutators[$key]);
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
                    case 'int':
                        $value = (int)$value;
                        break;
                    case 'real':
                    case 'float':
                    case 'double':
                        $value = (float)str_replace(',', '.', $value);
                        break;
                    case 'db_bool':
                        $value = strtoupper($value);
                        $value = ('Y'==$value || true===$value || '1'===$value || 1===$value) ? 'Y' : 'N';
                        break;
                    case 'phone':
                        $value = str_replace(['+', ' ', '(', ')', '-'], '', $value);
                        if (10 == strlen($value)) $value = '7'.$value;
                        if (11 == strlen($value) && '8'==$value[0]) $value[0] = '7';
                        break;
                    default:
                        break;
                }

            }
        }

        parent::setAttribute($key, $value);
    }


    /**
     * Преобразование на чтение
     *
     * @param string $key
     * @param mixed  $value
     * @return bool|mixed
     */
    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        $types = explode('|', $this->getCastType($key));
        foreach ($types as $type) {
            switch ($type) {
                case 'db_bool':
                    $value = ('Y'==$value);
                    break;
                case 'phone':
                    if (11==strlen($value)) {
                        $value = sprintf('+%s (%s) %s-%s-%s', $value[0], substr($value, 1, 3), substr($value, 4, 3), substr($value, 7, 2), substr($value, -2));
                    }
                    break;
                default:
                    $value = parent::castAttribute($key, $value);
            }
        }

        return $value;
    }


    /**
     * @param $key
     * @return bool
     */
    public function hasAttribute($key)
    {
        return array_key_exists($key, $this->attributes);
    }
}
