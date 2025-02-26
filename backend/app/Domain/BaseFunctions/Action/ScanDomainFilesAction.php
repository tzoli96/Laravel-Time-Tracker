<?php

namespace App\Domain\BaseFunctions\Action;

use Illuminate\Support\Facades\File;
use InvalidArgumentException;
use App\Domain\BaseFunctions\DataTransferObject\ScanParametersDto;
use App\Domain\BaseFunctions\DataTransferObject\ScanDirectoryParametersDto;
use App\Domain\BaseFunctions\Action\ScanDirectorAction;

class ScanDomainFilesAction extends AbstractAction
{
    public function __invoke(ScanParametersDto $scanParams): ScanResultDto
    {
        return $this->executeWithLogging(function () use ($scanParams) {
            $domainsPath = base_path($scanParams->basePath);

            if (!File::exists($domainsPath)) {
                throw new InvalidArgumentException("Base path does not exist: {$scanParams->basePath}");
            }

            $scanDirectorDto = new ScanDirectoryParametersDto(
                $domainsPath,
                $scanParams->foldersToScan,
                $scanParams->extension
            );

            return ScanResultDto::fromFiles($scanDirectorDto);
        }, 'ScanDomainFilesAction');
    }
}
