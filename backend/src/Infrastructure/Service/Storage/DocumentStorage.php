<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Storage;

use Symfony\Component\Filesystem\Filesystem;
use App\Application\Service\Storage\DocumentStorageInterface;
use App\Application\Dto\Input\Document\GenerateReportDocumentInputDto;
use App\Application\Dto\Output\External\StoredDocumentOutputDto;

final class DocumentStorage implements DocumentStorageInterface
{
    private Filesystem $filesystem;

    public function __construct(
        private string $storagePath, 
        private string $publicUrlPrefix
    ) {
        $this->storagePath = rtrim($storagePath, '/');
        $this->publicUrlPrefix = rtrim($publicUrlPrefix, '/');
        $this->filesystem = new Filesystem();
    }

    public function storeDocumentReportService(GenerateReportDocumentInputDto $inputDto): StoredDocumentOutputDto
    {
        $fullPath = $this->storagePath . '/document_' . $inputDto->id . '.pdf';

        // Sauvegarde le fichier
        $this->filesystem->dumpFile($fullPath, $inputDto->content);

        // Récupère la taille du fichier
        $length = (string) strlen($inputDto->content);

        // Construit l'URL publique si exposée via nginx ou autre
        $url = $this->publicUrlPrefix . '/document_' . $inputDto->id . '.pdf';

        return new StoredDocumentOutputDto(
            filename: '/document_' . $inputDto->id . '.pdf',
            path: $fullPath,
            url: $url,
            length: $length
        );
    }
}
