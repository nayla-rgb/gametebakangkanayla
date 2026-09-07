```php
<?php
session_start();

// Membuat game baru
if (!isset($_SESSION['angka'])) {
    $_SESSION['angka'] = rand(1, 50);
    $_SESSION['kesempatan'] = 3;
    $_SESSION['skor'] = 0;
    $_SESSION['pesan'] = "";
    $_SESSION['selesai'] = false;
    $_SESSION['riwayat'] = [];
}

$angka = $_SESSION['angka'];

// Jika tombol Tebak ditekan
if (isset($_POST['tebak']) && !$_SESSION['selesai']) {

    $tebak = $_POST['tebak'];

    // Simpan tebakan ke riwayat
    $_SESSION['riwayat'][] = $tebak;

    // Kurangi kesempatan
    $_SESSION['kesempatan']--;

    if ($tebak == $angka) {

        // Hitung skor
        $_SESSION['skor'] = $_SESSION['kesempatan'] * 100;

        $_SESSION['pesan'] = "
            <div class='correct'>
                🎉 Tebakan Anda BENAR!<br>
                Angka rahasianya adalah <b>$angka</b><br>
                🏆 Skor Anda: <b>{$_SESSION['skor']}</b>
            </div>
        ";

        $_SESSION['selesai'] = true;

    } else {

        if ($tebak < $angka) {

            $_SESSION['pesan'] = "
                <div class='wrong'>
                    ❌ Tebakan Anda SALAH!<br>
                    💡 Petunjuk: Angka rahasianya <b>lebih besar</b>.
                </div>
            ";

        } else {

            $_SESSION['pesan'] = "
                <div class='wrong'>
                    ❌ Tebakan Anda SALAH!<br>
                    💡 Petunjuk: Angka rahasianya <b>lebih kecil</b>.
                </div>
            ";
        }

        // Jika kesempatan habis
        if ($_SESSION['kesempatan'] <= 0) {

            $_SESSION['pesan'] .= "
                <br>
                😢 Kesempatan Anda sudah habis!<br>
                Angka yang benar adalah <b>$angka</b>
            ";

            $_SESSION['selesai'] = true;
        }
    }
}

// Tombol Main Lagi
if (isset($_POST['reset'])) {

    $_SESSION['angka'] = rand(1, 50);
    $_SESSION['kesempatan'] = 3;
    $_SESSION['skor'] = 0;
    $_SESSION['pesan'] = "";
    $_SESSION['selesai'] = false;
    $_SESSION['riwayat'] = [];
}

$kesempatan = $_SESSION['kesempatan'];
$skor = $_SESSION['skor'];
$pesan = $_SESSION['pesan'];
$riwayat = $_SESSION['riwayat'];

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Game Tebak Angka</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;

            font-family: Arial, sans-serif;

            background: linear-gradient(
                135deg,
                #667eea,
                #764ba2
            );

            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .game-container {
            width: 420px;

            background: white;

            padding: 35px;

            border-radius: 20px;

            box-shadow:
                0 10px 30px
                rgba(0, 0, 0, 0.25);

            text-align: center;
        }

        .game-icon {
            font-size: 55px;
        }

        .game-title {
            font-size: 30px;

            font-weight: bold;

            color: #4f46e5;

            margin: 10px 0;
        }

        .description {
            color: #666;

            margin-bottom: 20px;
        }

        .info {
            display: flex;

            justify-content: space-between;

            gap: 10px;

            margin-bottom: 20px;
        }

        .info-box {
            width: 50%;

            background: #f3f4f6;

            padding: 12px;

            border-radius: 10px;

            font-weight: bold;

            color: #4f46e5;
        }

        .input-number {
            width: 100%;

            padding: 14px;

            border: 2px solid #ddd;

            border-radius: 10px;

            font-size: 18px;

            text-align: center;

            outline: none;

            margin-bottom: 15px;
        }

        .input-number:focus {
            border-color: #667eea;
        }

        .btn-tebak,
        .btn-reset {
            width: 100%;

            padding: 14px;

            border: none;

            border-radius: 10px;

            color: white;

            font-size: 17px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;
        }

        .btn-tebak {
            background: linear-gradient(
                135deg,
                #667eea,
                #764ba2
            );
        }

        .btn-reset {
            background: #22c55e;

            margin-top: 10px;
        }

        .btn-tebak:hover,
        .btn-reset:hover {
            transform: translateY(-2px);

            opacity: 0.9;
        }

        .result {
            margin: 20px 0;

            padding: 15px;

            border-radius: 10px;

            background: #f8fafc;

            line-height: 1.8;
        }

        .correct {
            color: #16a34a;

            font-weight: bold;
        }

        .wrong {
            color: #dc2626;

            font-weight: bold;
        }

        /* Riwayat Tebakan */
        .history {
            margin-top: 20px;

            padding: 15px;

            background: #f3f4f6;

            border-radius: 10px;

            text-align: left;
        }

        .history-title {
            font-weight: bold;

            color: #4f46e5;

            margin-bottom: 10px;

            text-align: center;
        }

        .history-list {
            display: flex;

            flex-wrap: wrap;

            justify-content: center;

            gap: 8px;
        }

        .guess-number {
            background: white;

            border: 1px solid #ddd;

            padding: 8px 13px;

            border-radius: 20px;

            font-weight: bold;

            color: #555;
        }

        .range {
            margin-top: 20px;

            font-size: 13px;

            color: #888;
        }

    </style>

</head>

<body>

<div class="game-container">

    <div class="game-icon">
        🎯
    </div>

    <div class="game-title">
        Game Tebak Angka
    </div>

    <div class="description">
        Tebak angka rahasia dari <b>1 sampai 50</b>
    </div>

    <div class="info">

        <div class="info-box">
            🎯 Kesempatan<br>
            <?= $kesempatan ?>
        </div>

        <div class="info-box">
            🏆 Skor<br>
            <?= $skor ?>
        </div>

    </div>

    <?php if ($pesan != ""): ?>

        <div class="result">
            <?= $pesan ?>
        </div>

    <?php endif; ?>


    <?php if (!$_SESSION['selesai']): ?>

        <form method="POST">

            <input
                type="number"
                name="tebak"
                class="input-number"
                min="1"
                max="50"
                placeholder="Masukkan angka 1 - 50"
                required
            >

            <button
                type="submit"
                name="tebak"
                class="btn-tebak">

                🎲 Tebak Sekarang

            </button>

        </form>

    <?php else: ?>

        <form method="POST">

            <button
                type="submit"
                name="reset"
                class="btn-reset">

                🔄 Main Lagi

            </button>

        </form>

    <?php endif; ?>


    <!-- Riwayat Tebakan -->

    <?php if (count($riwayat) > 0): ?>

        <div class="history">

            <div class="history-title">
                📋 Riwayat Tebakan
            </div>

            <div class="history-list">

                <?php foreach ($riwayat as $nomor): ?>

                    <div class="guess-number">
                        <?= htmlspecialchars($nomor) ?>
                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    <?php endif; ?>


    <div class="range">
        💡 Tebak angka 1 sampai 50 dengan 3 kesempatan.
    </div>

</div>

</body>

</html>
```
