<?php
require 'auth.php';
require 'checkconnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="toastr.min.css" />
  <script src="jquery-3.6.0.min.js"></script>
  <script src="toastr.min.js"></script>
  <script>
    $(document).ready(function() {
    //toastr.info('Are you the 6 fingered man?')
    toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-full-width",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
    });
    </script>

</head>

<body>
  <div class="header">
    <h1>Breaking news playout System</h1>
    <br>
    <h2> Connection status :<span style="color:  <?php echo $_SESSION['color']; ?>;"> <?php echo $_SESSION['status']; ?> </span></h2>
  </div>
  <div>
    <form action="playout.php" method="POST">
      <?php if (isset($_SESSION['success']) &&($_SESSION['status']!=="Disconnected") && !empty($_SESSION['success'])) { ?>
        <div id="success" class="radio">
        <?php  echo "<script type='text/javascript'>toastr.success('Breaking News was sucessfully Pushed to GFX!')</script>";?>
        </div>
      <?php
        unset($_SESSION['success']);
        unset($_SESSION['status']);
      }
      ?>

<?php if (isset($_SESSION['stopped'])  && !empty($_SESSION['stopped'])) { ?>
        <div id="success" class="radio">
        <?php  echo "<script type='text/javascript'>toastr.success('GFX Cleared!')</script>";?>
        </div>
      <?php
        unset($_SESSION['stopped']);
      }
      ?>
      <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) { ?>
        <div id="error" class="radio">
          <label style="color: red;" for="value1" class="sex"> <?php  echo "<script type='text/javascript'>toastr.error('Error Sending Request!')</script>";?></label>
        </div>
      <?php
        unset($_SESSION['errors']);
      }
      ?>
      <input type="text" name="title" placeholder="Breaking News Headline" />
      <input maxlength="80" type="text" name="content" placeholder="News Content" />
      <input type="submit" value="Send" />
      <input form="stop-form" type="submit" value="Clear GFX" />
    </form>
    <form action="stop.php" method="POST" id="stop-form">

    </form>
  </div>

</body>
</html>
