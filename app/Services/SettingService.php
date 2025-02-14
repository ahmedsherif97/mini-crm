<?php

namespace App\Services;

class SettingService
{
    public function __construct(protected $settings)
    {
    }

    public function list()
    {
        return $this->settings;
    }

    public function find(string $slug)
    {
        return $this->settings->where('slug', $slug)->value('value');
    }
}
