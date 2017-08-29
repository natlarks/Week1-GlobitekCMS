<?php

  //Returns if value is blank
  function is_blank($value='') {
    return ($value == '');
  }

  //Returns if value fits length requirements
  function has_length($value, $options=array()) {
    // TODO
    return (strlen($value)<=$options[0]||strlen($value)>=$options[1]);
  }

  //Returns if it is a valid email address
  function has_valid_email_format($value) {
    
    return strpos($value, "@") == FALSE;
  }

?>
