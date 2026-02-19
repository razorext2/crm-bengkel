<?php

namespace App\Helpers;

class JasaKirim
{
    public static function jasaKirim(?string $id): ?array
    {
        if (! $id) {
            return null;
        }

        $services = config('crm.jasa_kirm', []);

        foreach ($services as $service) {
            if ($service['id'] === $id) {
                return $service;
            }
        }

        return null;
    }

    public static function jasaKirimName(?string $id): ?string
    {
        return self::jasaKirim($id)['name'] ?? null;
    }

    public static function jasaKirimUrl(?string $id): ?string
    {
        return self::jasaKirim($id)['url'] ?? null;
    }
}
