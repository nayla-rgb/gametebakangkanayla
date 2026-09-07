<?php

echo '
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Tebak Angka</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .game-container {
            width: 400px;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .game-title {
            font-size: 30px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 10px;
        }

        .game-icon {
            font-size: 55px;
            margin-bottom: 10px;
        }

        .description {
            color: #666;
            font-size: 15px;
            margin-bottom: 25px;
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

        .btn-tebak {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-tebak:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            background: #f3f4f6;
            color: #333;
            font-size: 16px;
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

        .range {
            margin-top: 20px;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>

<body>

<div class="game-container">

    <div class="game-icon">🎯</div>

    <div class="game-title">
        Game Tebak Angka
    </div>

    <div class="description">
        Tebak angka rahasia dari <b>1 sampai 5</b>!
    </div>
';

$x = rand(1, 5);

// Jika tombol Tebak sudah ditekan
if (isset($_POST['tebak'])) {

    $tebak = $_POST['tebak'];

    echo '<div class="result">';
    echo "Angka yang Anda tebak: <b>$tebak</b><br>";

    if ($tebak == $x) {
        echo '<span class="correct">🎉 Tebakan Anda Benar!</span>';
    } else {
        echo '<span class="wrong">❌ Tebakan Anda Salah!</span>';
    }

    echo '</div>';
}

echo '
    <form method="POST">

        <input
            type="number"
            name="tebak"
            class="input-number"
            min="1"
            max="5"
            placeholder="Masukkan angka 1 - 5"
            required
        >

        <button type="submit" class="btn-tebak">
            🎲 Tebak Sekarang
        </button>

    </form>

    <div class="range">
        💡 Pilih angka antara 1 sampai 5
    </div>

</div>

</body>
</html>
';
?>