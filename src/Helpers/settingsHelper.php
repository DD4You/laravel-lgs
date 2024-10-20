<?php

if (!function_exists('g_settings')) {
    function settings($key = null, $fetch = false, $onlyValue = true)
    {
        $settings = app()->make('\DD4You\Lgs\Models\GlobalSetting');

        if (empty($key)) {
            return $settings->all();
        }

        return $settings->get($key, $fetch, $onlyValue);
    }
}
