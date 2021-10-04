<?php

function sanitize($string){
  return htmlentities($string, ENT_QUOTES, 'UTF-8');
}
