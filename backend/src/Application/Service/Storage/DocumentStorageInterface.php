<?php

declare(strict_types=1);

namespace App\Application\Service\Storage;

use App\Application\Dto\Input\Document\GenerateReportDocumentInputDto;
use App\Application\Dto\Output\External\StoredDocumentOutputDto;

interface DocumentStorageInterface
{
    public function storeDocumentReportService(GenerateReportDocumentInputDto $inputDto): StoredDocumentOutputDto;
}
