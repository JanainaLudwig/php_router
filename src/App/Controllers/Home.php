<?php
namespace App\App\Controllers;

class Home {
  public function home() {
    echo 'home';
  }

  public function user($user) {
    echo "Welcome {$user}"; 
  }
}