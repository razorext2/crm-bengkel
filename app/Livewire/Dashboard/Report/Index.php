<?php

namespace App\Livewire\Dashboard\Report;

use Livewire\Component;

class Index extends Component
{
    public ?string $laporan_type = '';

    public ?string $date_from = '';

    public ?string $date_to = '';

    public ?array $status = [];

    public ?array $status_choice = [];

    public function make()
    {
        $model = $this->laporan_type;

        // buat query
        $data = $model::query()->when($this->status, function ($query) {
            dd($this->status);
            foreach ($this->status as $field => $value) {
                $query->where($field, $value);
            }
        })->get();

        dd($data->toArray());
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
                                'value' => true,
                                'label' => 'Selesai',
                            ],
                            [
                                'value' => false,
                                'label' => 'Belum Selesai',
                            ],
                        ],
                    ],
                    [
                        'field' => 'is_delivered',
                        'value' => [
                            [
                                'value' => true,
                                'label' => 'Sudah Dikirim',
                            ],
                            [
                                'value' => false,
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
