<?php
class Input{
  public static function exists($type = 'post'){
    switch($type){
      case 'post':
        return (!empty($_POST)) ? true : false ;
      break;
      case 'get':
        return (!empty($_GET)) ? true : false ;
      break;
      default:
        return false;
      break;
    }
  }

  public static function get($name, $type = 'post'){
    switch($type){
      case 'post':
        return (isset($_POST[$name])) ? $_POST[$name] : false ;
      break;
      case 'get':
        return (isset($_GET[$name])) ? $_GET[$name] : false ;
      break;
      default:
        return false;
      break;
    }
  }

}
