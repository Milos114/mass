<?php

namespace App\Console\Commands;

use App\Services\Juicer\Apple;
use App\Services\Juicer\Juicer\JuicerService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Random\RandomException;

class CreateJuice extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:juice {--color=} {--count=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws RandomException
     */
    public function handle(JuicerService $juicer): void
    {
        $rottenApples = 0;
        $totalApples = [];

        for ($i = 0; $i < $this->option('count'); $i++) {
            $apple = new Apple(color: $this->option('color'));
            if ($apple->isRotten) {
                $this->info('Apple is rotten');
                $rottenApples++;
                continue;
            }
            $juicer->container()->addFruit($apple);
            $this->info('Apple volume: ' . $apple->volume);
            $totalApples[] = $apple;
        }

        $this->info('Total apples in container: ' . count($juicer->container()->getFruit()));
        $this->info('Total volume in container: ' .  $juicer->container()->totalVolumeOccupied());
        $this->info('Space left in container: ' . $juicer->container()->capacity);
        $this->info('Total rotten apples: ' . $rottenApples);

        $this->info('Total juice volume: ' . $juicer->strainer()->squeeze($totalApples));
    }
}
