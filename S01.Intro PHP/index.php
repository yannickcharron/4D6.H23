<?php
    require_once("./models/Champion.php");
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction PHP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body class="d-flex flex-column h-100">
    <header>
        <?php include('core/navbar.php'); ?>
    </header>
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Champions</h1>
        
        <div class="row">
        <?php
            $connection = mysqli_connect("localhost:3307", "root", "", "semaine01-classe");
            if($connection->connect_errno > 0) {
                die("Impossible de se connecter à la base de données $connection->connect_errno");
            } else {
                $sql = "SELECT idChampion, name FROM champions ORDER BY name";
                if(!$result = $connection->query($sql)) {
                    die('Erreur dans la requête SQL');
                } else {
                    while($row = $result->fetch_assoc()) {
                        // var_dump($row); // Aide pour déboguer
                        $champion = new Champion($row);
                        echo "<div class='col-2 card mx-2 my-2'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title text-center'>{$champion->name}</h5>";
                            echo "<img class='mx-auto d-block' src='http://ddragon.leagueoflegends.com/cdn/13.1.1/img/champion/{$champion->name}.png' />";
                            echo "</div>";
                        echo "</div>";
                    }
                    $result->free();
                }
                $connection->close();
            }

        ?>
        </div>
        </div>
    </main>
    



    <?php include('core/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>