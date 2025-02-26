<?php

namespace App\Providers;

use App\Domain\BaseFunctions\Action\ScanDomainFilesAction;
use App\Domain\BaseFunctions\DataTransferObject\ScanParametersDto;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @throws Throwable
     */
    public function boot(): void
    {
        $dto = new ScanParametersDto(['stubs']);
        $result = app(ScanDomainFilesAction::class)($dto);
        foreach ($result->files as $migrationPath) {
            $this->loadMigrationsFrom($migrationPath);
        }
    }
}
