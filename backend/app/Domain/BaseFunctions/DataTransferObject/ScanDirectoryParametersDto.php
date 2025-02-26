<?php
namespace App\Domain\BaseFunctions\DataTransferObject;

class ScanDirectoryParametersDto
{
    public function __construct(
        public string $domainsPath,
        public array $foldersToScan,
        public string $extension
    ) {}

}

