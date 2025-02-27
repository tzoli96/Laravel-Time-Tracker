<?php

namespace Database\Seeders;

use App\Domain\BaseFunctions\Action\ScanDomainFilesAction;
use App\Domain\BaseFunctions\DataTransferObject\ScanParametersDto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dto = new ScanParametersDto(['Seeders']);
        $result = app(ScanDomainFilesAction::class)($dto);

        foreach ($result->files as $seederPath) {
            $relativePath = str_replace(base_path() . '/', '', $seederPath);
            $seederClass = str_replace('.php', '', $relativePath);

            if (class_exists($seederClass)) {
                $this->call($seederClass);
            }
        }

    }
}
