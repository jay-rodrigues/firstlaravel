<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class KeyGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'key:generate {length}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to generate random encryption key';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Will handle what is going on - The wise words of AMac the Lesser

        //Read the comment above please
        $length = $this->argument('length');

        return 0;
    }
}
