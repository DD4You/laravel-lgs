<?php

if (!function_exists('g_settings')) {
    function settings($key = null, $fetch = false)
    {
        $settings = app()->make('\DD4You\Lgs\Models\GlobalSetting');

        if (empty($key)) {
            return $settings;
        }

        return $settings->get($key, $fetch);
    }
}
