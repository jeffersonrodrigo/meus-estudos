<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rick and Morty api</title>
</head>
<body>
    <?php
        $url = "https://rickandmortyapi.com/api/character";

        $resultado = json_decode(file_get_contents($url));
        // var_dump($resultado);

        foreach($resultado->results as $personagens){
            $avatar = $personagens->image;
            echo "<img src='{$avatar}' alt='{$avatar}'" . "<br>";
            echo "<br>";
            echo "$personagens->name" . "<br>";
            echo "$personagens->status" . "<br>";
            echo "$personagens->species" . "<br>";
            echo "<hr>";
        }
    ?>
</body>
</html><img src='{