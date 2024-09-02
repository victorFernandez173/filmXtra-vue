<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class VictorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:vic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando de testeo de Víctor';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('hhola queu tal');
    }
}
