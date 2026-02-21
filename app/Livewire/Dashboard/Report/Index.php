<?php

namespace App\Livewire\Dashboard\Report;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Livewire\Component;

class Index extends Component
{
    public ?string $laporan_type = '';

    public ?string $date_from = '';

    public ?string $date_to = '';

    public ?array $status = [];

    public ?array $status_choice = [];

    public function rules()
    {
        return [
            'laporan_type' => 'required',
        ];
    }

    public function make()
    {
        $model = $this->laporan_type;

        $data = $model::query()
            ->when($this->status, function ($query) {
                foreach ($this->status as $field => $value) {
                    $query->where($field, $value);
                }
            })
            ->when($this->date_from && $this->date_to, function ($query) {
                $query->whereBetween('created_at', [
                    $this->date_from,
                    $this->date_to,
                ]);
            })
            ->get()
            ->map(function ($item) {
                return json_decode(
                    json_encode($item, JSON_UNESCAPED_UNICODE),
                    true
                );
            });

        $pdf = Pdf::loadView('dashboard.report.template.transaction', [
            'orders' => $data,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'transaksi-'.Str::ulid().'.pdf');
    }

    public function updatedLaporanType()
    {
        $status = match ($this->laporan_type) {
            '\App\Models\Transaction' => [
                'status' => [
                    [
                        'field' => 'is_completed',
                        'value' => [
                            [
                                'value' => 1,
                                'label' => 'Selesai',
                            ],
                            [
                                'value' => 0,
                                'label' => 'Belum Selesai',
                            ],
                        ],
                    ],
                    [
                        'field' => 'is_delivered',
                        'value' => [
                            [
                                'value' => 1,
                                'label' => 'Sudah Dikirim',
                            ],
                            [
                                'value' => 0,
                                'label' => 'Belum Dikirim',
                            ],
                        ],
                    ],
                    [
                        'field' => 'order_status',
                        'value' => [
                            [
                                'value' => 0,
                                'label' => 'Menunggu Pembayaran',
                            ],
                            [
                                'value' => 1,
                                'label' => 'Pembayaran Diterima',
                            ],
                            [
                                'value' => 2,
                                'label' => 'Pesanan Dikirim',
                            ],
                            [
                                'value' => 3,
                                'label' => 'Pesanan Diterima',
                            ],
                            [
                                'value' => 4,
                                'label' => 'Pesanan Dibatalkan',
                            ],
                        ],
                    ],
                ],
            ],
            '\App\Models\User' => [
                'status' => [

                ],
            ]
        };

        $this->status_choice = $status;
    }

    public function render()
    {
        $data = [
            [
                'label' => 'Transaksi Penjualan',
                'model' => '\App\Models\Transaction',
                'view' => 'dashboard.report.template.transaction',
            ],
            // [
            //     'label' => 'Data Pelanggan',
            //     'model' => '\App\Models\User',
            // ],
            // [
            //     'label' => 'Data Produk',
            //     'model' => '\App\Models\Product',
            // ],
        ];

        return view('livewire.dashboard.report.index', [
            'models' => $data,
        ]);
    }
}
