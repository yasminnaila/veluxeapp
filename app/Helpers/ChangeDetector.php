<?php

namespace App\Helpers;

class ChangeDetector
{
    public static function detect(array $old, array $new): string
    {
        $changes = [];

        foreach ($new as $key => $value) {
            if (!array_key_exists($key, $old)) continue;

            if ($old[$key] != $value) {
                $changes[] = "{$key}: {$old[$key]} → {$value}";
            }
        }

        return implode(', ', $changes);
    }
}
