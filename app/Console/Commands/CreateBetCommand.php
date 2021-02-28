<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use  App\Http\Controllers\GenerateGame;  

class CreateBetCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Bet on me";

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
     * @return mixed
     */
    public function handle()
    {
       
       GenerateGame::game(); 
    }

}