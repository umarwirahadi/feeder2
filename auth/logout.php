<?php 
// session_start();
unset($_SESSION['token']);
session_destroy();
echo '<script>location.href="auth/login.php"</script>';
 ?>