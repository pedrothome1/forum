<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $guarded = [];

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
}
