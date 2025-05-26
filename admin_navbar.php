<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['login_name'])) {
    $_SESSION['login_name'] = "Guest";
}
?>

<!-- Admin Navbar -->
<header style="background: #000; padding: 10px 20px;">
  <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
    <!-- Admin Panel Title -->
    <div style="color:rgb(255, 255, 255); font-size: 28px; font-weight: bold;">
      ADMIN PANEL
    </div>

    <!-- Navigation -->
    <nav style="display: flex; gap: 20px; flex-wrap: wrap;" id="top-nav">
      <a href="./index.php?page=home" style="color: white; text-decoration: none;" class="nav-home">🏠 Home</a>
      <a href="./index.php?page=booked" style="color: white; text-decoration: none;" class="nav-booked">🪑 Reservations</a>

      <!-- Dropdown for Services -->
      <div style="position: relative;">
        <a href="#" style="color: white; text-decoration: none;">🛠 Services ⌄</a>
        <div style="position: absolute; background: #222; padding: 10px; display: none; flex-direction: column;">
          <a href="./index.php?page=bus" style="color: white; padding: 5px 0;">🚌 List Bus</a>
          <a href="./index.php?page=location" style="color: white; padding: 5px 0;">📍 List Location</a>
        </div>
      </div>

      <a href="admin_reports.php" style="color: white; text-decoration: none;">💬 View Reports</a>
      <a href="./index.php?page=schedule" style="color: white; text-decoration: none;" class="nav-schedule">🧾 Manage Schedule</a>
      <a href="admin_feedback_chart.php" style="color: white; text-decoration: none;">📊 Feedback Chart</a>
      <a href="view_bookings.php" style="color: white; text-decoration: none;">📋 View Bookings</a>

      <!-- Dropdown for User -->
      <div style="position: relative;">
        <a href="#" style="color: white; text-decoration: none;"><?php echo htmlspecialchars($_SESSION['login_name']); ?> ⌄</a>
        <div style="position: absolute; background: #222; padding: 10px; display: none; flex-direction: column;">
          <a href="./logout.php" style="color: white; padding: 5px 0;">🚪 Logout</a>
        </div>
      </div>
    </nav>
  </div>
</header>

<!-- Script for dropdowns -->
<script>
  $(document).ready(function(){
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>';
    if(page !== ''){
      $('#top-nav a').removeClass('active');
      $('#top-nav .nav-' + page).addClass('active');
    }

    // Dropdown toggle
    $('nav > div').hover(function(){
      $(this).find('div').first().stop(true).slideDown(150);
    }, function(){
      $(this).find('div').first().stop(true).slideUp(150);
    });
  });
</script>
