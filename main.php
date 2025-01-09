<?php

function postNewRow($bdd) {
    if (!isset($_POST['ville']) || !isset($_POST['max']) || !isset($_POST['min'])) {
        return;
    }

    $ville = ucfirst($_POST['ville']);
    $max = $_POST['max'];
    $min = $_POST['min'];

    try {
        $bdd->query("INSERT INTO meteo (ville, max, min) VALUES ('$ville', '$max', '$min')");
    } catch(PDOException $exception) {
        echo '<p style="color:red;">' . $exception->getMessage() . '</p>';
    }
}

function deleteRow($bdd) {
    if (!isset($_POST['delete'])) {
        return;
    }

    $ville = $_POST['delete'];

    echo $ville;

    try {
        $bdd->query("DELETE FROM meteo WHERE 'ville'='$ville'");
    } catch(PDOException $exception) {
        echo '<p style="color:red;">' . $exception->getMessage() . '</p>';
    }
}

try {
	$bdd = new PDO('mysql:host=localhost;dbname=weather;charset=utf8', 'root', '');
} catch(PDOException $exception) {
    die($exception->getMessage());
};

postNewRow($bdd);

try {
    $data = $bdd->query('SELECT ville, max, min FROM meteo');
} catch(PDOException $exception) {
    die($exception->getMessage());
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
        <td>{$row['ville']}</td>
        <td>{$row['max']}</td>
        <td>{$row['min']}</td>
    </tr>
    END;
};
$result .= '</table>';
echo $result;

?>

<form action="main.php" method="post">
    <input type="text" placeholder="Entrez une ville" name="ville" id="ville" required/>
    <input type="text" placeholder="Entrez la température max du jour" name="max" id="max" required/>
    <input type="text" placeholder="Entrez la température min du jour" name="min" id="min" required/>
    <input type="submit" value="Envoyer"/>
</form>
