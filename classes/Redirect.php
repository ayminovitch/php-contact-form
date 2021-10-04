<?php

class Redirect{
  public static function re(){
    header('Refresh: 0');
    exit();
  }
}
