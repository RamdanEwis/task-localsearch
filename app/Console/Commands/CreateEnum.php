<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateEnum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:enumCreate {name} {values*}';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Enum class enum:create {name} {values*}';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $enumName = $this->argument('name');
        $enumValues = $this->argument('values');

        $enumContent = "<?php\n\nnamespace App\Enum;\n\n";
        $enumContent .= "enum $enumName :string \n ";
        $enumContent .= "{\n";
        foreach ($enumValues as $enumValue) {
            $enumContent .= "    case " . strtoupper($enumValue) . " = '$enumValue';\n";
        }
        $enumContent .= "}\n";
        file_put_contents(app_path("Enum/$enumName.php"), $enumContent);

        $this->info("Enum $enumName created successfully!");
    }
}
