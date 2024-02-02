<?php
?>
<header>
  <nav>
    <ul>
      <?php if (isset($_SESSION['username'])): ?>
        <li>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></li>
        <li><a href="logout.php">Logout</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
