<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo "<p>PHP et HTML entrelacés</p>";
    ?>
    <div>
        <?php
            $maVariable = 42;
            echo "<p>{$maVariable}</p>";
            echo "<?php  ?>";
        ?>
    </div>
</body>
</html>