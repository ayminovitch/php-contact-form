<?php
session_start();
require_once 'config/Config.php';
require_once 'functions/sanitize.php';
spl_autoload_register(function($class){
  require_once "classes/{$class}.php";
});
