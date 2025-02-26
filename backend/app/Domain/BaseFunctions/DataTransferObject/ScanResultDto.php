<?php
namespace App\Domain\BaseFunctions\DataTransferObject;

class ScanResultDto
{
    public array $files;

    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public static function fromFiles(array $files): self
    {
        return new self($files);
    }
}
