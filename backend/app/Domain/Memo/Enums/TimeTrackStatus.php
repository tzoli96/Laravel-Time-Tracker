<?php

namespace App\Domain\Memo\Enums;

enum TimeTrackStatus: string
{
    case DRAFT = 'draft';
    case FINAL = 'final';
}
