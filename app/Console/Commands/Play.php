<?php

namespace App\Console\Commands;

use App\Flappy;
use App\Phlappy;
use Illuminate\Console\Command;

class Play extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Play Phlappy';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(Phlappy::class)->prompt();
    }
}
