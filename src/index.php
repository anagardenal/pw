<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PW-2</title>
</head>
<body>
    <?php
        require ('./functions.php'); 

        echo'<h3>Soma v1</h3>';
        echo '<p style="color:red;">Soma: '.somar_v1().'</p>';
        echo '<hr/>';

        echo'<h3>Soma v2</h3>';
        somar_v2();
        echo '<hr/>';

        echo'<h3>Soma v3</h3>';
        echo '<p>Soma: '.somar_v3(7,8).'</p>';
        echo '<hr/>';
    ?>
</body>
</html>