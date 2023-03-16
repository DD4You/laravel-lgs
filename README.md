[![Latest Stable Version](http://poser.pugx.org/dd4you/lgs/v)](https://packagist.org/packages/dd4you/lgs)
[![Daily Downloads](http://poser.pugx.org/dd4you/lgs/d/daily)](https://packagist.org/packages/dd4you/lgs)
[![Monthly Downloads](http://poser.pugx.org/dd4you/lgs/d/monthly)](https://packagist.org/packages/dd4you/lgs)
[![Total Downloads](http://poser.pugx.org/dd4you/lgs/downloads)](https://packagist.org/packages/dd4you/lgs)
[![License](http://poser.pugx.org/dd4you/lgs/license)](https://packagist.org/packages/dd4you/lgs)
[![PHP Version Require](http://poser.pugx.org/dd4you/lgs/require/php)](https://packagist.org/packages/dd4you/lgs)

# Laravel Global Settings

Store general settings like website name, logo url, contacts in the database easily.
Everything is cached, so no extra query is done.
You can also get fresh values from the database directly if you need.

## Installation

Install the package via composer

```bash
composer require dd4you/lgs
```

Setup

```bash
php artisan dd4you:install-lgs
```

Migrate the database

```bash
php artisan migrate
```

I have also added seeder for some general settings a website needs.
Seed the database using command:

```code
php artisan db:seed --class=SettingsSeeder
```

## Usage/Examples

To store settings on database

```code
settings()->set(
        'key',
        ['label'=>'Label Name','value'=>'Value Name']
    );
```

You can also set multiple settings at once

```code
settings()->set([
        'key1'=>[
            'label'=>'Label Name',
            'value'=>'Value Name',
            'type'=>settings()->fileType()
            ],
        'key2'=>[
            'label'=>'Label Name',
            'value'=>'Value Name'
            ],
    ]);
```

You can retrieve the settings from cache using any command below

```code
settings('key');
settings()->get('key');
settings()->get(['key1', 'key2']);
```

Want the settings directly from database? You can do it,

```code
settings('key',true);
settings()->get('key',true);
settings()->get(['key1', 'key2'],true);
```

Getting all the settings stored on database

```code
settings()->getAll();
```

You can use the settings on blade as

```code
{{ settings('site_name')['value'] }}
```

Or, if you have html stored on settings

```code
{!! settings('footer_text')['value'] !!}
{!! settings('footer_text')['value'] Copyright Date('Y') !!}
```

Finally, If you have changed something directly on database, Don't forget to clear the cache.

```code
php artisan cache:clear
```

## License

[MIT](https://choosealicense.com/licenses/mit/)

## Feedback

If you have any feedback, please reach out at vinay@dd4you.in or submit a pull request here.

## Authors

- [@dd4you](https://www.github.com/DD4You)

## Badges

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
