<?php
namespace App\Requests;

class Request {
    
    public function __construct() {
        $this->boot();
    }

    private function boot()
    {
        foreach($_SERVER as $key => $value)
        {
            $this->{strtolower($key)} = $value;
        }
    }
}