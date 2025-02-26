<?php

namespace App\Domain\BaseFunctions\Action;

use Illuminate\Support\Facades\File;
use App\Domain\BaseFunctions\DataTransferObject\ScanDirectoryParametersDto;
use Throwable;

class ScanDirectorAction extends AbstractAction
{
    /**
     * @throws Throwable
     */
    public function __invoke(ScanDirectoryParametersDto $scanDirectoryParametersDto): array {
        return $this->executeWithLogging(function () use ($scanDirectoryParametersDto) {
            $files = [];

            foreach (File::directories($scanDirectoryParametersDto->domainsPath) as $domain) {
                foreach ($scanDirectoryParametersDto->foldersToScan as $folder) {
                    $fullPath = "{$domain}/{$folder}";

                    if (!File::exists($fullPath)) {
                        continue;
                    }

                    $scannedFiles = File::glob("{$fullPath}/*.{$scanDirectoryParametersDto->extension}");
                    $files = array_merge($files, $scannedFiles);
                }
            }

            return $files;
        }, 'ScanDirectorAction');
    }
}
