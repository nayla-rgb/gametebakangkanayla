<?php

echo "<p>Game Tebak Angka</p>";
$x = rand(1, 5);
// Jika tombol Tebak sudah ditekan
if (isset($_POST['tebak'])) {
    $tebak = $_POST['tebak'];
    echo "Angka yang Anda tebak: $tebak<br>";
    if ($tebak == $x) {
        echo "Tebakan Anda Benar!";
    } else {
        echo "Tebakan Anda Salah!";
    }
}
?>
<form method="POST">
    <input type="number" name="tebak" min="1" max="5">
    <button type="submit">Tebak</button>
</form>