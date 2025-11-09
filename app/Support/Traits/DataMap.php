<?php

namespace App\Support\Traits;

use Illuminate\Support\Str;

trait DataMap
{
    public static function arrayKeysToSnake(array &$data): void
    {
        foreach ($data as $key => $value) {
            $newKey = Str::snake($key);

            if ($newKey === $key) {
                if (is_array($value)) {
                    static::arrayKeysToSnake($data[$key]);
                }
                continue;
            }

            unset($data[$key]);
            $data[$newKey] = is_array($value)
                ? static::arrayKeysToSnake($value = &$value)
                : $value;
        }
    }
}
