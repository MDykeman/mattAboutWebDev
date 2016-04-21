<?php
  if (($_SERVER['REQUEST_METHOD'] == 'POST') && (!empty($_POST['action']))):

    if (isset($_POST['name'])) { $name = $_POST['name']; }
    if (isset($_POST['email'])) { $email = $_POST['email']; }
    if (isset($_POST['message'])) { $message = $_POST['message']; }
    if (isset($_POST['requesttype'])) { $requesttype = $_POST['requesttype']; }
    if (isset($_POST['ajaxrequest'])) { $ajaxrequest = $_POST['ajaxrequest']; }


    $formerrors = false;

    if($name == ''):
      $err_name = '<div class="error">Sorry, name is a required field</div>';
      $formerrors = true;
    endif;//name input field empty

    if(!(preg_match('/[A-Za-z]+/', $name))):
      $err_name_patternmatch = '<div class="error">Please only place letters in the name field</div>';
      $formerrors = true;
    endif;//name pattern doesn't mb_ereg_match

    if($message == ''):
      $err_message = '<div class="error">Whoops, looks like you forgot to fill out your message</div>';
      $formerrors = true;
    endif;

    $formdata = array (
    'name' => $name,
    'email' => $email,
    'message' => $message,
    'request_type' => $requesttype
  );

  if (!($formerrors)):
    $to       =   "mail@mattaboutwebdev.com";
    $subject  =   "Mail From MAWD sent from $name";
    $message  =   json_encode($formdata);

    $replyto = "From: fromprocessor@iviewsource.com \r\n".
               "Reply-To: mail@mattaboutwebdev.com \r\n";

    if (mail($to, $subject, $message)):
      $msg = "Thank you for getting in touch with me. I'll get back to you as soon as possible.";
    else:
      $msg = "Uh oh, There was a problem sending your message please try again later.";
    endif; //mail form data

  endif;//check form for errors

  endif; //form submitted
?>
