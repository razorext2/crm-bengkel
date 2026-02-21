<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Data Transaksi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .kop {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop h2 {
            margin: 0;
        }

        .kop p {
            margin: 2px 0;
        }

        .title {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>

    {{-- kop surat --}}
    <div class="kop">
        <h2>MOL JAYA MOTOR</h2>
        <p>Jl. Lintas Sumatera, Dusun II Pulau Maria, Kecamatan Teluk Dalam, Kabupaten Asahan</p>
        <p>Telp: (+62) 822-1763-1230 | Email: moljayamotor.asahan@gmail.com</p>
    </div>

    <div class="title">
        LAPORAN DATA TRANSAKSI
    </div>

    <p>
        Dicetak pada: {{ now()->format('d M Y H:i:s') }}
    </p>

    {{-- data --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Resi</th>
                <th>Status</th>
                <th>Jasa Kirim</th>
                <th>Ongkir</th>
                <th>Dikirim</th>
                <th>Tgl Dikirim</th>
                <th>Selesai</th>
                <th>Tgl Selesai</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
            @endphp

            @forelse($orders as $index => $order)
                @php
                    $grandTotal += $order['total_amount'];
                @endphp

                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order['invoice_number'] }}</td>
                    <td>{{ $order['user']['name'] }}</td>
                    <td class="text-right">
                        Rp {{ number_format($order['total_amount'], 0, ',', '.') }}
                    </td>
                    <td>{{ $order['resi_number'] ?? '-' }}</td>
                    <td>{{ $order['order_status_description']['description'] ?? '-' }}</td>
                    <td>
                        {{ \App\Helpers\JasaKirim::jasaKirimName($order['shipping_service']) ?? '-' }}
                    </td>
                    <td class="text-right">
                        Rp {{ number_format($order['shipping_cost'], 0, ',', '.') }}
                    </td>
                    <td>{{ $order['is_delivered'] ? 'Dikirim' : 'Belum' }}</td>
                    <td>
                        {{ $order['delivered_at'] ? \Carbon\Carbon::parse($order['delivered_at'])->format('d M Y H:i:s') : '-' }}
                    </td>
                    <td>{{ $order['is_completed'] ? 'Selesai' : 'Belum' }}</td>
                    <td>
                        {{ $order['completed_at'] ? \Carbon\Carbon::parse($order['completed_at'])->format('d M Y H:i:s') : '-' }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($order['created_at'])->format('d M Y H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" style="text-align:center;">Tidak ada data transaksi</td>
                </tr>
            @endforelse
        </tbody>

        @if (count($orders) > 0)
            <tfoot>
                <tr>
                    <th colspan="3">TOTAL</th>
                    <th colspan="10" class="text-right">
                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                    </th>
                </tr>
            </tfoot>
        @endif

    </table>

    <div class="footer">
        <p style="margin: 0; padding: 0;">Air Batu, {{ now()->format('d M Y') }}</p>
        <p style="margin: 0; padding: 0;">Pemilik,</p>
        <br><br><br>
        <p style="text-decoration: underline"> MULYONO </p>
    </div>

</body>

</html>
