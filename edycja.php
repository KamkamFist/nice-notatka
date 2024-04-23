<?php

$hn = "localhost";
$sn = "root";
$ps = "";
$db = "notatka";

$cnn = mysqli_connect($hn, $sn, $ps, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST['note_id']) && isset($_POST['edited_content']) && !empty($_POST['note_id'])) {
 
        $note_id = $_POST['note_id'];
        $edited_content = mysqli_real_escape_string($cnn, $_POST['edited_content']);

        $query = "UPDATE `notatki` SET `notatka`='$edited_content' WHERE `id`='$note_id'";

        $result = mysqli_query($cnn, $query);

        if ($result) {
            header("Location: notatka.php");
            exit();
            
        } 
    } 
}

mysqli_close($cnn);
?>
