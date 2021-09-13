<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="stylesheet" href="admin/css/styles.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/calendar.css">
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />


  <!--mystylesheet-->
  <title>EC Fleet Management</title>

  <!-- Hotjar Tracking Code for http://webdev.edinburghcollege.ac.uk/~HNDSOFTS2A4/ -->
  <script>
    (function(h, o, t, j, a, r) {
      h.hj = h.hj || function() {
        (h.hj.q = h.hj.q || []).push(arguments)
      };
      h._hjSettings = {
        hjid: 2213582,
        hjsv: 6
      };
      a = o.getElementsByTagName('head')[0];
      r = o.createElement('script');
      r.async = 1;
      r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
      a.appendChild(r);
    })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
  </script>

  <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth'
      });
      calendar.render();
    });
  </script>

</head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link <?php if ($currentPage == 'booking') {
                                echo 'active';
                              } ?>" href="booking.php">Booking<span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
    <div class="mx-auto order-0">
      <a class="navbar-brand" href="index.php"><img class="logo" style="height: 50px; width: 100px;" src="img/Logo.png" alt="Edinburgh College"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php if ($currentPage == 'account') {
                              echo 'active';
                            } ?> ">
          <a class="nav-link" id="userDropdown" href="#" data-toggle="dropdown" aria-expanded="false" aria-controls="userDropdown">
            <div class="sb-nav-link-icon"> <?php
                                            $user = $_SESSION['forename'];
                                            echo "Hi $user";
                                            ?><em class="fas fa-user fa-fw"></em><em class="fas fa-angle-down"></em></div>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="user_login.php">Account</a>
            <a class="dropdown-item" href="booking.php">Bookings</a>
            <?php
            if ($_SESSION['account_level'] == "2") {
            ?>
              <a class="dropdown-item" href="/admin/admin.php">Admin</a>
            <?php
            }
            ?>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="includes/logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>