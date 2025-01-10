<?php
    function connectToDatabase(): PDO {
        try {
            // Change the login info inside PDO() if needed
            $connexion = new PDO('mysql:host=localhost;dbname=weather;charset=utf8', 'root', '');
            return $connexion;
        } catch(PDOException $exception) {
            echo '<p style="color:red;">' . $exception->getMessage() . '</p>';
            die();
        }
    }

    function insertInto(PDO $connexion) {
        if (!isset($_POST['city']) || !isset($_POST['max']) || !isset($_POST['min'])) {
            return;
        }

        $city = ucfirst($_POST['city']);
        $max = $_POST['max'];
        $min = $_POST['min'];

        try {
            $connexion->query("INSERT INTO meteo (city, max, min) VALUES ('$city', '$max', '$min')");
        } catch(PDOException $exception) {
            echo '<p style="color:red;">' . $exception->getMessage() . '</p>';
        }
    }

    function deleteFrom(PDO $connexion) {
        if (!isset($_GET['city'])) {
            return;
        }

        $city = $_GET['city'];

        try {
            $connexion->query("DELETE FROM meteo WHERE city='$city'");
        } catch(PDOException $exception) {
            echo '<p style="color:red;">' . $exception->getMessage() . '</p>';
        }
    }

    function loadData(PDO $connexion) {
        try {
            $data = $connexion->query('SELECT city, max, min FROM meteo');
        } catch(PDOException $exception) {
            echo '<p style="color:red;">' . $exception->getMessage() . '</p>';
            die();
        }

        $result = <<<END
        <table>
            <tr>
                <th>Ville</th>
                <th>Max (°C)</th>
                <th>Min (°C)</th>
            </tr>
        END;
        foreach ($data as $row) {
            $result .= <<<END
            <tr>
                <td>{$row['city']}</td>
                <td>{$row['max']}</td>
                <td>{$row['min']}</td>
                <td>
                    <a href="index.php?city={$row['city']}".$ style="color:red;">X</a>
                </td>
            </tr>
            END;
        };
        $result .= '</table>';
        echo $result;
    }

    $connexion = connectToDatabase();
    insertInto($connexion);
    deleteFrom($connexion);
    loadData($connexion);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
</head>

<body>
    <form action="index.php" method="post">
        <input type="text" placeholder="Entrez une ville" name="city" id="city" required/>
        <input type="text" placeholder="Entrez la température max du jour" name="max" id="max" required/>
        <input type="text" placeholder="Entrez la température min du jour" name="min" id="min" required/>
        <input type="submit" value="Envoyer"/>
    </form>
</body>
</html>
