<?php

if (isset($_POST['hitung'])) {

    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    if ($harga < 0) {
        $pesan = "Harga tidak boleh negatif!";
    } elseif ($jumlah < 1) {
        $pesan = "Jumlah pembelian minimal 1!";
    } else {

        $total = $harga * $jumlah;

        if ($total >= 500000) {
            $diskon = 20;
        } elseif ($total >= 250000) {
            $diskon = 10;
        } else {
            $diskon = 0;
        }

        $potongan = $total * $diskon / 100;
        $bayar = $total - $potongan;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Pembayaran</title>

    <style>
        body {
            font-family: Arial;
            margin: 40px;
        }

        h2 {
            margin-bottom: 25px;
        }

        input {
            padding: 7px;
            width: 300px;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        button {
            padding: 8px 18px;
            cursor: pointer;
        }

        .hasil {
            margin-top: 25px;
            line-height: 1.8;
        }
    </style>
</head>

<body>

<h2>Aplikasi Pembayaran Barang</h2>

<form method="POST">

    Nama Barang<br>
    <input type="text" name="nama_barang" required>
    <br>

    Harga Satuan<br>
    <input type="number" name="harga" min="0" required>
    <br>

    Jumlah Pembelian<br>
    <input type="number" name="jumlah" min="1" required>
    <br>

    <button type="submit" name="hitung">Hitung Pembayaran</button>

</form>

<?php if (isset($pesan)) { ?>

    <p style="color:red;">
        <?= $pesan ?>
    </p>

<?php } ?>

<?php if (isset($_POST['hitung']) && !isset($pesan)) { ?>

    <div class="hasil">

        <h3>Hasil Pembayaran</h3>

        Nama Barang : <?= htmlspecialchars($nama) ?><br>
        Harga Satuan : Rp<?= number_format($harga, 0, ',', '.') ?><br>
        Jumlah Pembelian : <?= $jumlah ?><br>
        Total Harga : Rp<?= number_format($total, 0, ',', '.') ?><br>
        Diskon : <?= $diskon ?>%<br>
        Total Pembayaran :
        <b>Rp<?= number_format($bayar, 0, ',', '.') ?></b>

    </div>

<?php } ?>

</body>
</html>