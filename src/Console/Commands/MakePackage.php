<?php

namespace PackageMaker\Console\Commands;

use PackageMaker\Library\PackageMakerHelper;
use PackageMaker\Models\PackageMaker;
use PackageMaker\Models\PackageMakerSetting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakePackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'packagemaker:make {packagename} {ClassName?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заготовка команды';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public $author;
    public $className;
    public $ind;

    public function ReplaceText($f)
    {
        $f = str_replace('MakePackage::class,', '', $f);
        $f = str_replace('packagemaker', $this->ind, $f);
        $f = str_replace('PackageMaker', $this->className, $f);
        $f = str_replace('slavawins', $this->author, $f);
        return $f;
    }

    public function ReplaceFile($path)
    {
        $f = file_get_contents($path);
        $f = $this->ReplaceText($f);

        if (substr_count(basename($path), $this->className)) {
            File::delete($path);
            $fname = basename($path);
            $fname = $this->ReplaceText($fname);
            $path = str_replace(basename($path), $fname, $path);
        }
        file_put_contents($path, $f);
    }

    public function handle()
    {
        $packagename = $this->argument("packagename");
        $className = $this->argument("ClassName");

        $packagename = strtolower($packagename);
        if (substr_count($packagename, '/') <> 1) {
            $this->error("Нужно так логингитхаба/названиепакета  и всё слитно с маленьких букв");
            return;
        }
        $this->author = explode('/', $packagename)[0];
        $this->ind = explode('/', $packagename)[1];

        if (empty($className)) $className = strtoupper(substr($this->ind, 0, 1)) . substr($this->ind, 1);
        $this->className = $className;

        $vendorPath = __DIR__ . '/../../../../../';

        $vendorPathAuthor = $vendorPath . $this->author;
        $vendorPathPackage = $vendorPath . $this->author . '/' . $this->ind;
        if (!file_exists($vendorPathAuthor)) mkdir($vendorPathAuthor);

        \File::copyDirectory($vendorPath . 'slavawins/packagemaker', $vendorPathPackage);


        File::copy($vendorPathPackage . '/_README.md', $vendorPathPackage . '/README.md');
        File::delete($vendorPathPackage . '/_README.md');

        $ignore = [];
        $ignore['MakePackage.php'] = true;
        foreach (File::allFiles($vendorPathPackage) as $K => $V) {
            $this->ReplaceFile($V);
        }


        $this->info("Пакет создан. Ищите в вендоре");
    }
}
