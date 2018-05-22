<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Store a flash message in the session.
     *
     * @param  string  $message
     * @param  string  $name
     * @param  string  $class
     * @return void
     */
    public function flash($message, $name = 'status', $class = 'success')
    {
        session()->flash($name, $message);
        session()->flash('class', $class);
    }
}
