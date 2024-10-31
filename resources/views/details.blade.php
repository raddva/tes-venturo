<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        td,
        th {
            font-size: 11px;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>

    <title>Detail Transaksi</title>
</head>
<?php
$month_name = date('F', mktime(0, 0, 0, $month, 10));
?>

<body>
    <div class='container py-2'>
        <div class="col">
            <h2>Detail Transaksi {{ $menu }} bulan {{ $month_name }} Tahun {{ $year }}</h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1; ?>

                @foreach ($transaksi as $t)
                    <?php
                    $bulan = date('m', strtotime($t['tanggal']));
                    $tanggal = date('l, j M Y', strtotime($t['tanggal']));
                    ?>
                    @if ($t['menu'] == $menu && $bulan == $month)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $tanggal }}</td>
                            <td>{{ number_format($t['total']) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
