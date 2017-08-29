<?php
  require_once('../private/initialize.php');

  $errors=array();

  //If the form is submitted, it will process and validate the data
  if (isset($_POST['Submit1'])){

    //Retrieves all of the fields from the form
    $first_name=sanitize_text_field($_POST['first_name']);
    $last_name=sanitize_text_field($_POST['last_name']);
    $email=sanitize_email(sanitize_text_field($_POST['email']));
    $username=sanitize_text_field($_POST['username']);


    //Checks if fields are blank
    if (is_blank($first_name)){
      array_push($errors, "First name cannot be blank.");
    }
    if (is_blank($last_name)){
      array_push($errors, "Last name cannot be blank.");
    }
    if (is_blank($email)){
      array_push($errors, "Email cannot be blank.");
    }
    if (is_blank($username)){
      array_push($errors, "Username cannot be blank.");
    }


    //Checks lengths of fields
    if (has_length($first_name, [2,255])){
      array_push($errors, "First name must be between 2 and 255 characters.");
    }
    if (has_length($last_name, [2,255])){
      array_push($errors, "Last name must be between 2 and 255 characters.");
    }

    if (has_length($email, [1,255])){
      array_push($errors, "Email must be between 1 and 255 characters.");
    }

    if (has_length($username, [8,255])){
      array_push($errors, "Username must be at least 8 characters.");
    }


    //Validates email address
    if (has_valid_email_format($email)){
      array_push($errors, "Email must be valid format.");
    }

    if (count($errors)==0){

      /*Inserts form values into database
      ID is auto-incremented and time stamp and automated by the DB*/
       $sql = "INSERT INTO users (first_name, last_name, email, username)
              VALUES ('$first_name', '$last_name', '$email', '$username');";

      //If successful, it redirects them to a success page
       $result = db_query($db, $sql);
       if($result) {
         db_close($db);
         header("Location: registration_success.php");

       } else {
         echo db_error($db);
         db_close($db);
          
       }
    }
  }
?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php

    //Outputs errors if there are any
    if (count($errors)!=0){

      echo "Please fix the following errors: ";
      echo "<ul>";

      //Iterates through errors and outputs them in a list
      foreach ($errors as $error){
        echo "<li>".$error."</li>";
      }

      echo "</ul>";
    }
  
  ?>

  <!-- Form to collect data -->
  <form method="POST" action="register.php">

    First name:<br><input type="text" name="first_name">
    <br>
    Last name:<br><input type="text" name="last_name">
    <br>
    Email:<br><input type="text" name="email">
    <br>
    Username:<br><input type="text" name="username">

    <br>
    <br>

    <input type="submit" name="Submit1" value="Submit">
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php');?>