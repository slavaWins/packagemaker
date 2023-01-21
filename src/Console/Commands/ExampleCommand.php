<?php

namespace PackageMaker\Console\Commands;

use PackageMaker\Library\PackageMakerHelper;
use PackageMaker\Models\PackageMaker;
use PackageMaker\Models\PackageMakerSetting;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'packagemaker:example';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заготовка команды packagemaker';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        $this->info("packagemaker - Команда выполнена");
    }
}
