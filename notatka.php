<?php

$hn = "localhost";
$sn = "root";
$ps = "";
$db = "notatka";

$cnn = mysqli_connect($hn, $sn, $ps, $db);

if (empty($_POST) == false) {

    $tytul = $_POST['t1'];
    $tresc = $_POST['t2'];

    $query = ("INSERT INTO `notatki`(`tyul`, `notatka`) VALUES ('$tytul', '$tresc')");

    $result = mysqli_query($cnn, $query);
}

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="styl.css">

<body>
    <h1>to moje emo notatki</h1>

    <div id="all">
        <?php


        $query = ("select id, tyul, notatka from notatki");

        $result = mysqli_query($cnn, $query);


        while ($row = mysqli_fetch_assoc($result)) {

            echo "<div id='note'>";

            echo $row['tyul'] . "<br>";
            echo $row['notatka'] . "<br><br>";
            echo "<a href='usuwanie.php?id=" . $row['id'] . "'>" . "🚮" . "</a>";
            echo "<form action='edycja.php' method='post'>";
            echo "<input type='hidden' name='note_id' value='" . $row['id'] . "'>";
            echo "<textarea name='edited_content' rows='2' cols='39'>" . $row['notatka'] . "</textarea><br>";
            echo "<button type='submit'>Zapisz zmiany</button>";
            echo "</form>";

            echo "</div>";
        }


        ?>





        </button>
    </div>


    <div id="add">

        <form action="notatka.php" method="post">
            <label for="t1">Tytul</label>
            <input name="t1" type="text"><br>
            <label for="t2">Tresc</label>
            <input name="t2" type="text"><br>

            <button type="submit"> dodaj notatke</button>

        </form>



    </div>


</body>

</html>