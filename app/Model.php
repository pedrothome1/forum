<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    /**
     * @var array
     */
    protected $guarded = [];


    /**
     * The path to the given model.
     *
     * @param  string  $additional
     * @return string
     */
    public function path($additional = '')
    {
        if ($additional) {
            $additional = '/'.trim($additional, '/');
        }

        $resource = get_called_class();

        if ($position = strrpos($resource, '\\')) {
            $resource = substr($resource, $position + 1);
            $resource = Str::plural(Str::lower($resource));
        }

        return '/'.$resource.'/'.$this->{$this->getRouteKeyName()}.$additional;
    }

    /**
     * Get the name of the model's unique identifier.
     *
     * @return string
     */
    public function getIdentifierAttribute()
    {
        return $this->getRouteKeyName();
    }
}
