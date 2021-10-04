<?php

class Validation{
  private $_passed = false,
          $_errors = array();

  public function check($source, $items = array()){
    foreach($items as $item => $rules){
      $value = sanitize($source[$item]);
      foreach($rules as $rule => $rule_value){
        switch($rule){
          case 'required':
            if(empty($value) || empty(str_replace(" ", "", $value))){
              $this->_errors[$item] = $rule_value[1];
            }
          break;
          case 'min':
            if(strlen($value) < $rule_value[0]){
              $this->_errors[$item] = $rule_value[1];
            }
          break;
          case 'max':
            if(strlen($value) > $rule_value[0]){
              $this->_errors[$item] = $rule_value[1];
            }
          break;
          case 'regexp':
            if(!preg_match($rule_value[0], $value)){//regular expression
              $this->_errors[$item] = $rule_value[1];
            }
          break;
        }
      }
    }
    if(empty($this->_errors)){
      $this->_passed = true;
    }
  }

  public function passed(){
    return $this->_passed;
  }

  public function errors(){
    return $this->_errors;
  }

}
