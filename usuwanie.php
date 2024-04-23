<?php
$hn = "localhost";
$sn = "root";
$ps = "";
$db = "notatka";

$cnn = mysqli_connect($hn, $sn, $ps, $db);

if(isset($_GET['id'])) {
    $usun = $_GET['id'];

    $query = "DELETE FROM notatki WHERE id = $usun";

    $result = mysqli_query($cnn, $query);

    if($result) {
        header("Location: notatka.php");
        exit();
    } 
}
mysqli_close($cnn);
?>
