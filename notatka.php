<?php
$hn = "localhost";
$sn = "root";
$ps = "";
$db = "notatka";

$cnn = mysqli_connect($hn, $sn, $ps, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
   
    $tytul = $_POST['t1'];
    $tresc = $_POST['t2'];
    $kategoria = $_POST['kategoria'];

    $query = "INSERT INTO `notatki`(`tyul`, `notatka`, `kategoria`) VALUES ('$tytul', '$tresc', '$kategoria')";
    $result = mysqli_query($cnn, $query);
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mega notatnik</title>
</head>
<link rel="stylesheet" href="styl.css">


<body>
<div id="baner">
    to moje emo notatki
    <div id="search">
        <form action="" method="post">
            <input type="text" name="szukaj" placeholder="Wyszukaj notatkę">
            <button type="submit">Szukaj</button>
        </form>
    </div>
</div>
    <div id="zawartosc">

    <div id="all">
    <form action="" method="post">
        <select name="filtry">
            <option value="">Wszystkie kategorie</option>
            <option value="Dom">Dom</option>
            <option value="Praca">Praca</option>
            <option value="Plany">Plany</option>
        </select>
        <button type="submit">Filtruj</button>
    </form>

    <?php
$filtr = isset($_POST['filtry']) ? $_POST['filtry'] : '';
$szukanie = isset($_POST['szukaj']) ? $_POST['szukaj'] : '';

if (!empty($szukanie)) {
    $query = "SELECT id, tyul, notatka, kategoria FROM notatki WHERE tyul LIKE '%$szukanie%' OR notatka LIKE '%$szukanie%'";
} else if (!empty($filtr) && $filtr != "Wszystkie kategorie") {
    $query = "SELECT id, tyul, notatka, kategoria FROM notatki WHERE kategoria = '$filtr'";
} else {
    $query = "SELECT id, tyul, notatka, kategoria FROM notatki";
}

$result = mysqli_query($cnn, $query);

while ($row = mysqli_fetch_assoc($result)) {

            echo "<div id='note'>";

            echo $row['tyul'] . "<br>";
            echo $row['notatka'] . "<br><br>";
            echo "<a href='usuwanie.php?id=" . $row['id'] . "'>" . "🚮" . "</a>";
            echo "<form action='edycja.php' method='post'>";
            echo "<input type='hidden' name='note_id' value='" . $row['id'] . "'>";
            echo "<textarea id='edycja' name='edited_content' rows='3' cols='37' style='overflow:hidden;'>" . $row['notatka'] . "</textarea><br>";
            echo "<button type='submit'>Zapisz zmiany</button>";
            echo "</form>";

            echo "</div>";
        }

        mysqli_close($cnn);
        
        ?>





        </button>
    </div>


    <div id="add">

    <form action="notatka.php" method="post">
    <input id="tytulwow" name="t1" type="text" placeholder="Tytul"><br><br>
    <textarea name='t2' id="trescwow" rows='3' cols='37' placeholder="Tresc"></textarea><br>
    <select id="filtr" name="kategoria">
        <option value="Dom">Dom</option>
        <option value="Praca">Praca</option>
        <option value="Plany">Plany</option>
    </select>
    <button type="submit" name="submit">Dodaj notatkę</button>
</form>



    </div>

    </div>
</body>

</html>