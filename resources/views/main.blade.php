<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        td,
        th {
            font-size: 11px;
        }
    </style>


    <title>TES - Venturo Camp Tahap 2</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu
            </div>
            <div class="card-body">
                <form action="{{ route('transaksi') }}" method="get">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select id="my-select" class="form-control" name="year">
                                    <option value="">Pilih Tahun</option>
                                    <option value="2021" {{ $year == '2021' ? 'selected' : ''}}>2021</option>
                                    <option value="2022" {{ $year == '2022' ? 'selected' : ''}}>2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                            @if (isset($year))
                                
                            <a href="http://tes-web.landa.id/intermediate/menu" target="_blank" rel="Array Menu" class="btn btn-secondary">
                                Json Menu
                            </a>
                            <a href="http://tes-web.landa.id/intermediate/transaksi?tahun=<?= $year; ?>" target="_blank" rel="Array Transaksi" class="btn btn-secondary">
                                Json Transaksi
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
                @if (isset($year))
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="margin: 0;">
                        <thead>
                            <tr class="table-dark">
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                                <th colspan="12" style="text-align: center;">Periode Pada <?= $year; ?>
                                </th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                            </tr>
                            <tr class="table-dark">
                                <th style="text-align: center;width: 75px;">Jan</th>
                                <th style="text-align: center;width: 75px;">Feb</th>
                                <th style="text-align: center;width: 75px;">Mar</th>
                                <th style="text-align: center;width: 75px;">Apr</th>
                                <th style="text-align: center;width: 75px;">Mei</th>
                                <th style="text-align: center;width: 75px;">Jun</th>
                                <th style="text-align: center;width: 75px;">Jul</th>
                                <th style="text-align: center;width: 75px;">Ags</th>
                                <th style="text-align: center;width: 75px;">Sep</th>
                                <th style="text-align: center;width: 75px;">Okt</th>
                                <th style="text-align: center;width: 75px;">Nov</th>
                                <th style="text-align: center;width: 75px;">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                            </tr>
                            <?php 
                            $grand = array_fill(1, 12, 0);
                            $sumall = 0;
                            ?>
                            @foreach ($menu as $m)
                            <tr>
                                @if($m['kategori'] == 'makanan')
                                    <td>{{$m['menu']}}</td>
                                    <?php 
                                    $sum = 0; ?>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <?php $mTotal = 0; ?>
                                        @foreach ($transaksi as $t)
                                            @if ($t['menu'] == $m['menu'])
                                                <?php 
                                                    $month = date("m",strtotime($t['tanggal']));
                                                    if ($month == $i) {
                                                        $mTotal += $t['total'];
                                                        $grand[$i] += $t['total'];
                                                    }
                                                ?>
                                            @endif
                                        @endforeach
                                        <td style="text-align: right;">
                                            {{ $mTotal != 0 ? number_format($mTotal) : ''}}
                                        </td>
                                        <?php 
                                        $sum += $mTotal;
                                        $sumall += $mTotal;
                                        ?>
                                    @endfor
                                    <td style="text-align: right;"><b>{{ $sum != 0 ? number_format($sum) : 0 }}</b></td>
                                @endif
                            </tr>
                            @endforeach
                            <tr>
                                <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                            </tr>
                            @foreach ($menu as $m)
                            <tr>
                                @if ($m['kategori'] == 'minuman')
                                <td>{{ $m['menu'] }}</td>
                                <?php $sum = 0; ?>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <?php $mTotal = 0; ?>
                                        @foreach ($transaksi as $t)
                                            @if ($t['menu'] == $m['menu'])
                                                <?php 
                                                    $month = date("m",strtotime($t['tanggal']));
                                                    if ($month == $i) {
                                                        $mTotal += $t['total'];
                                                        $grand[$i] += $t['total'];
                                                    }
                                                ?>
                                            @endif
                                        @endforeach
                                        <td style="text-align: right;">
                                            {{ $mTotal != 0 ? number_format($mTotal) : ''}}
                                        </td>
                                        <?php
                                        $sum += $mTotal; 
                                        $sumall += $mTotal;
                                        ?>
                                    @endfor
                                    <td style="text-align: right;"><b>{{ $sum != 0 ? number_format($sum) : 0 }}</b></td>
                                    @endif
                            </tr>
                            @endforeach
                            <tr class="table-dark">
                                <td><b>Total</b></td>
                                @foreach ($grand as $total)
                                    <td style="text-align: right;">
                                    <b>
                                        {{ $total != 0 ? number_format($total) : '' }}
                                    </b>
                                    </td>
                                @endforeach
                                <td style="text-align: right;"><b>{{$sumall != 0 ? number_format($sumall) : 0}}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>