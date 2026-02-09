<?php

namespace App\Livewire\Concerns;

use App\Exceptions\BusinessException;
use App\Helpers\ErrorLogger;
use Throwable;

trait HandlesErrors
{
    protected function runSafely(callable $callback, string $logMessage = 'Error tidak diketahui.', array $context = [])
    {
        try {
            return $callback();
        } catch (BusinessException $e) {
            // error bisnis yang akan dilihat user
            $this->addError('general', $e->getMessage());

            session()->flash('alert', [
                'type' => 'red',
                'title' => 'Gagal!',
                'message' => $e->getMessage(),
            ]);
        } catch (Throwable $e) {
            // error teknis, kasih pesan umum aja
            $errorId = ErrorLogger::log($e, $logMessage, $context);

            session()->flash('alert', [
                'type' => 'red',
                'title' => 'Gagal!',
                'message' => 'Terjadi kesalahan sistem. Kode: '.$errorId,
            ]);
        }
    }
}
