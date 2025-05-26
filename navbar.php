<style>
/* Clean Top Navbar */
.user-navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color:var_export ;
    padding: 10px 40px;
    border-radius: 0 0 15px 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    font-family: Arial, sans-serif;
}

.user-navbar .logo {
    color: black;
    font-size: 24px;
    font-weight: bold;
}

.user-navbar ul {
    list-style: none;
    display: flex;
    gap: 30px;
    margin: 0;
    padding: 0;
}

.user-navbar ul li a {
    color: black;
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s ease;
}

.user-navbar ul li a:hover {
    color: #FFD700;
    text-decoration: underline;
}
</style>

<div class="user-navbar">
    <div class="logo">USER PANEL</div>
    <ul>
        <li><a href="index.php?page=home">🏠 Home</a></li>
        <li><a href="index.php?page=schedule">🚌 Bus Schedule</a></li>
        <li><a href="index.php?page=available_bus">📋 Available Buses</a></li>
        <li><a href="index.php?page=report_issue">🔴 Report Issue</a></li>
        <li><a href="index.php?page=feedback">💬 Feedback</a></li>
        <li><a href="login.php">🔐 Login</a></li>
        <li><a href="register.php">📄 Register</a></li>
        <li><a href="admin.php">👨‍💼 Admin</a></li>
    </ul>
</div>
