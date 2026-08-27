<?php
// index.php
setcookie("usuario", "João Silva", time() + (86400 * 30)); // 86400 = 1 day
setcookie("email", "joao.silva@example.com", time() + (86400 * 30)); // 86400 = 1 day
setcookie("idade", "30", time() + (86400 * 30)); // 86400 = 1 day

?>

<a href="perfil.php">Ver perfil</a>