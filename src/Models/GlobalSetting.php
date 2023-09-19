<?php

namespace DD4You\Lgs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GlobalSetting extends Model
{
    protected $guarded = ['id'];
    protected $table = 'global_settings';

    public function set($key, $valueArr = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->set($k, $v);
            }

            return true;
        }

        $settings = $this->getModelName()->updateOrCreate(
            ['key' => $key],
            [
                'type' => $valueArr['type'] ?? $this->textType(),
                'label' => $valueArr['label'],
                'hint' => $valueArr['hint'] ?? 'Enter ' . $valueArr['label'],
                'value' =>  isset($valueArr['type']) && $valueArr['type'] === 'array' ? json_encode($valueArr['value']) : $valueArr['value'],
            ]
        );
        $this->forgetCache();

        return $settings;
    }

    public function getModelName()
    {
        return app('\DD4You\Lgs\Models\GlobalSetting');
    }

    public function forgetCache()
    {
        Cache::forget($this->getCacheName());
    }

    public function getCacheName(): string
    {
        return 'dpanel-settings';
    }
    public function get(mixed $key, $fetch = false, $onlyValue = true)
    {
        $settings = $this->getAll($fetch)->toArray();
        $filterSetting = is_array($key) ? [] : null;
        foreach ($settings as $setting) {
            if (is_array($key)) {
                foreach ($key as $k1) {
                    if (in_array($k1, array_values($setting))) {
                        $filterSetting[] = $setting;
                    }
                }
            } else {
                if (in_array($key, array_values($setting))) {
                    $filterSetting = $setting;
                }
            }
        }

        if ($onlyValue) {
            if (array_key_exists('value', $filterSetting)) {
                return $filterSetting['type'] == 'array' ? json_decode($filterSetting['value']) : $filterSetting['value'];
            }
        }

        return $filterSetting;
    }



    public function getAll($fetch = false)
    {
        if ($fetch) {
            $settings = $this->getModelName()->all(['key', 'type', 'label', 'hint', 'value']);
        } else {
            $settings = Cache::rememberForever($this->getCacheName(), function () {
                return $this->getModelName()->all(['key', 'type', 'label', 'hint', 'value']);
            });
        }

        return $settings;
    }



    public function remove($key)
    {
        if (is_array($key)) {
            foreach ($key as $k) {
                $this->delete($k);
            }

            return true;
        }
        $this->getModelName()->where('key', $key)->delete();
        $this->forgetCache();
    }

    public function has($key)
    {
        return $this->getAll()->has($key);
    }

    public function textType()
    {
        return 'text';
    }
    public function longTextType()
    {
        return 'longtext';
    }

    public function fileType()
    {
        return 'file';
    }

    public function arrayType()
    {
        return 'array';
    }
}
