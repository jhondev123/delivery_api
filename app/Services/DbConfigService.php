<?php

namespace App\Services;

use App\Models\Config;
use Illuminate\Support\Facades\Cache;

class DbConfigService
{
    public function get($key, $default = null)
    {
        return Cache::remember("config.{$key}", 60 * 24, function () use ($key, $default) {
            $config = Config::where('key', $key)->first();
            return $config ? $config->value : $default;
        });
    }

    public function set($key, $value)
    {
        Config::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("config.{$key}");
    }
  
}
