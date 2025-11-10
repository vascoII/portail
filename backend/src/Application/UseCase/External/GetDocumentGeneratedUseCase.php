<?php

declare(strict_types=1);

namespace App\Application\UseCase\External;

use App\Application\Dto\Input\Document\GenerateReportDocumentInputDto;
use App\Application\Dto\Output\External\GeneratedDocumentOutputDto;
use App\Application\Service\Builder\PdfReportBuilderInterface;
use App\Application\Service\Publisher\PublisherInterface;
use App\Application\Service\Storage\DocumentStorageInterface;

final class GetDocumentGeneratedUseCase
{
    public function __construct(
        private readonly DocumentStorageInterface $serviceStorage,
        private readonly PdfReportBuilderInterface $reportBuilderInterface,
        private readonly PublisherInterface $mercurePublisher
    ) {}

    public function execute(GenerateReportDocumentInputDto $inputDto): GeneratedDocumentOutputDto
    {
        $stored = $this->serviceStorage->storeDocumentReportService($inputDto);

        $this->mercurePublisher->publish($stored);

        return new GeneratedDocumentOutputDto(
            id: $inputDto->id,
            filename: $stored->filename,
            url: $stored->url,
            length: $stored->length
        );
    }
}
