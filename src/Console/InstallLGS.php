<?php

namespace DD4You\Lgs\Console;

use Illuminate\Console\Command;

class InstallLGS extends Command
{
    protected $signature = 'dd4you:install-lgs';

    protected $description = 'Publish Laravel Global Setting file';

    public function handle()
    {
        $this->info('Installing LGS...');

        $params = [
            '--provider' => "DD4You\Lgs\LgsServiceProvider",
            '--tag' => "migrations"
        ];

        $this->call('vendor:publish', $params);

        $this->info('Installed LGS');
    }
}
