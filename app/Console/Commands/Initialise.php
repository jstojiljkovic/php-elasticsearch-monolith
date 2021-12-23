<?php

namespace App\Console\Commands;

use App\Models\Random;
use App\Models\User;
use Illuminate\Console\Command;

class Initialise extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pem:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills the php elasticsearch monolith with data';

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
        $this->info('Preparing to initiate data...');
        $username = $this->ask('Please provide username of the initial created user?');
        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            $this->error(
                'User with the provided username does not exist. In order to run this script, first insert an user.'
            );
        }

        $amount = $this->ask('Please provide amount of data you wish to create?');

        $randomness = Random::factory()->count($amount)->make(['user_id' => $user->id]);

        $chunks = $randomness->chunk(2000);

        $this->withProgressBar($chunks, function ($chunk) {
            Random::insert($chunk->toArray());
        });

        return Command::SUCCESS;
    }
}
