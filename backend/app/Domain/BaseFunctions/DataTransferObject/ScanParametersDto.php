<?php
namespace App\Domain\BaseFunctions\DataTransferObject;

class ScanParametersDto
{
    public function __construct(
        public array $foldersToScan,
        public string $basePath = 'src/Domains',
        public string $extension = 'php'
    ) {}
}

