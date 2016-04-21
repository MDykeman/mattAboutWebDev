<?php ini_set('display_errors', '1');
include "process.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <title>Matt About Web Dev</title>
  <link rel="shortcut icon" href="http://www.mattaboutwebdev.com/favicon.ico" />
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="assets\font-awesome-4.5.0\css\font-awesome.min.css">
  <link rel="stylesheet" href="normalize.css">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="favicon.ico">
  <script>
    $(document).ready(function() {
      //Smooth Scroll
      $(function() {
            $('a[href*="#"]:not([href="#"])').click(function() {
              if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                  $('html, body').animate({
                    scrollTop: target.offset().top
                  }, 1700);
                  return false;
                }
              }
            });
      });
      $('#mobile-menu-open').click(function() {
          $('.mobile-li').slideToggle();
        });

      $('#myform').submit(function() {
        var abort = false;
        $("div.error").remove();
        $(':input[required]').each(function() {
          if($(this).val()==='') {
            $(this).after('<div class="error">Please fill out this field</div>');
          }
        });// go through each required value
        if (abort) { return false; } else {
        postData = $('#myform').serialize();
        $.post('process.php', postData+'&action=submit&ajaxrequest=1',
        function(msg) {
          if (msg) {
            $('#myform').before(msg);
          }
        });
        return false;
      }
      })//on submit
    });// Ready

    $('input[placeholder]').blur(function() {
      $('div.error').remove();
      var myPattern = $(this).attr('pattern');
      var myPlaceholder = $(this).attr('placeholder');
      var isValid = $(this).val().search(myPattern) >= 0;

      if (!isValid) {
        $(this).focus();
        $(this).after('<div class="error">Entry does not match expected pattern: ' + myPlaceholder + '</div>');
      }// isValid test
    });//onblur
  </script>
</head>
<body>
    <header>
      <div class="logo">
        <div class="dark-grey"></div>
        <img src="assets\mawd-logo-01-01.png" alt="Matt About Web Dev Logo">
        <div class="deep-yellow"></div>
      </div>
      <nav class="mobile-menu">
        <ul class="menu">
          <li><a id="mobile-menu-open"><i class="fa fa-bars" ></i>MENU</a></li>
          <div class="mobile-li">
            <li><a href="#aboutPage">ABOUT</a></li>
            <li><a href="#workPage">WORK</a></li>
            <li><a href="#contactPage">CONTACT</a></li>
          </div>
        </ul>
      </nav>
      <nav class="desktop-menu">
        <ul id="menu">
          <li><a href="#aboutPage">ABOUT</a></li>
          <li><a href="#workPage">WORK</a></li>
          <li><a href="#contactPage">CONTACT</a></li>
        </ul>
      </nav>
    </header>

    <div class="content">
        <section class="section about" id="aboutPage">
          <div class="about-content">
            <img src="assets\toonme.gif" alt="Cartoon of Matthew Dykeman Coding">

            <p>Hi, I'm Matthew Dykeman. A web developer with a marketing background based in Toronto, Ontario. My marketing background has given me the desire to create Web-Apps that are simple and easy to use. Ultimately resulting in the best User-Experience possible!</p>

            <a href="#workPage">
              <figure>
                <figcaption>check out my work</figcaption>
                <i class="fa fa-chevron-down"></i>
              </figure>
            </a>
          </div>

        </section>
        <section class="section work" id="workPage">
            <div class="slide countdown">
              <div class="work-wrapper">
              <img src="assets\ProjectCountdown.png" alt="Image of Project countdown on an Computer, Tablet and Mobile device">
              <a href="http://mattaboutwebdev.com/projectCountdown/home.html"><h2>Project Countdown</h2></a>
              <p>I initially made this as a way to give myself a heads up as to how much time I had to buy gifts for friends and family before Christmas day. While I was researching countdown clocks online I noticed that a lot of them had quite a few dependencies.  My main goal for this project was to create a very lightweight, simple web app. One that was independent of external libraries in an effort to keep load times down mainly for mobile users.
              I also want to make the project responsive on all devices. I achieved this by combining media queries with the flexbox module. To increase the immersion of the project I included the HTML5 Canvas. To render a snowfall in behind the countdown clock. I had a great time researching how to develop this project and hope you enjoy it as much as I do!</p>
              </div>
            </div>
            <div class="slide crimerate">
              <div class="work-wrapper ">
                <img class="crime-img" src="assets/howbadisit.png" alt="Picture of how bad is it web app">
                <a href="http://mattaboutwebdev.com/crime_rate/google-mapsapi.html">
                  <h2>How <span class="red-text">bad</span> is it?</h2>
                </a>
                <p>
                  I created this project to inform users of the crime rates in the Maritimes. When a user clicks on a red outlined province then a pop up informs them of the crimes that have been committed in that province in the last year.
                  This project was created using The Google Maps API, Fusion Tables and open data from the Canadian Government.
                </p>
              </div>
            </div>
        </section>
        <section class="section contact" id="contactPage">

          <div class="contact-div">

            <?php
              if (isset($msg)) :
                echo '<div id="formmessage"><p>', $msg , '</p></div>';
              else:
             ?>
          <form class="my-form group" id="myform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <fieldset title="Give me a Shout!">
              <legend>Give me a Shout!</legend>
            <ol>
              <li>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required pattern="[A-Za-z ]+" title="Please, enter your name" placeholder="John Smith" value="<?php if(isset($name)) { echo $name; } ?>" />
                <?php if (isset($err_name)) { echo $err_name; }  ?>
                <?php if (isset($err_patternmatch)) { echo $err_patternmatch;  }  ?>
              </li>
              <li>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="<?php if (isset($email)) { echo $email; }  ?>" />
                <?php if (isset($err_email)) { echo $err_email; } ?>
                <?php if (isset($err_patternmatch)) { echo $err_patternmatch; }  ?>
              </li>
              <li>
                <label class="message" for="message">Message</label>
                <textarea  name="message" id="message"><?php if(isset($message)) { echo $message; } ?></textarea>
              </li>
              <li>
                <button type="submit" name="action" value="submit">Send</button>
              </li>
            </ol>
            </fieldset>
          </form>
          <div class="button">
          <?php endif; ?>
            <a href="http://mattaboutwebdev.com/files/MattDykemanFront-EndResume.pdf" target="_blank">Download my Resume</a>
          </div>
          </div>
        </section>
    </div>
</body>
</html>
