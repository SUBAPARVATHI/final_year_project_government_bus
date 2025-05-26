<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Online Government Bus Reservation System</title>

  <!-- Link your CSS file here if not already -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/navbar.css"> <!-- if navbar CSS is separate -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style>
    /* Optional: Reset body margins for layout */
    body {
      margin: 0;
      padding: 0;
    }

    .main-content {
  margin-top: 90px; /* adjust height based on your navbar */
  padding: 20px;
}

    .navbar-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 10;
   /* Optional: dark clean bg */
  padding: 5px 0; /* less height padding */
}

  </style>
</head>


<body>
  <?php
    include 'header.php';
    include 'db_connect.php';
  ?>

<div class="navbar-wrapper"><!-- Navbar must come first and outside of any container to avoid center alignment -->
  <?php if (isset($_SESSION['login_id'])) {
      include 'admin_navbar.php';
    } else {
      include 'navbar.php';
    }
  ?>
  </div>

  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white"></div>
  </div>

  <div class="main-content">
  <?php 
  if(isset($_GET['page']) && !empty($_GET['page']))
  include($_GET['page'].'.php');
  else
    include('home.php');
?>
  </div>

  <!-- Modals -->
  <div class="modal fadeIn" tabindex="-1" id="uni_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success submit" onclick="$('#uni_modal form').submit()">
            <?php echo isset($_SESSION['login_id']) ? 'Save' : 'Find' ?>
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fadeIn" tabindex="-1" id="confirm_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="confirm" onclick="">Continue</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fadeIn" tabindex="-1" id="book_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"></div>
      </div>
    </div>
  </div>

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <script src="assets/js/main.js"></script>
  <script>
    window.uni_modal = function ($title = '', $url = '', $book = 0) {
      $('#uni_modal .modal-title').html($title);
      start_load();

      $.ajax({
        url: $url,
        error: err => console.log(err),
        success: function (resp) {
          $('#uni_modal .modal-body').html(resp);
          if ('<?php echo !isset($_SESSION['login_id']) ?>' == 1) {
            $('#uni_modal .submit').html($book == 1 ? 'Reserve' : 'Find');
          }
          $('#uni_modal .modal-footer').show();
          $('#uni_modal').modal('show');
        },
        complete: function () {
          end_load();
        }
      });
    }

    window._conf = function ($msg = '', $func = '', $params = []) {
      $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");
      $('#confirm_modal .modal-body').html($msg);
      $('#confirm_modal').modal('show');
    }

    window.start_load = function () {
      $('body').prepend('<div id="preloader2"></div>');
    }

    window.end_load = function () {
      $('#preloader2').fadeOut('fast', function () {
        $(this).remove();
      });
    }

    window.alert_toast = function ($msg = 'TEST', $bg = 'success') {
      $('#alert_toast').removeClass('bg-success bg-danger bg-info bg-warning').addClass('bg-' + $bg);
      $('#alert_toast .toast-body').html($msg);
      $('#alert_toast').toast({ delay: 3000 }).toast('show');
    }
  </script>
</body>
</html>
