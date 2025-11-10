<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Storage;

use App\Application\Dto\Input\Document\GenerateReportDocumentInputDto;
use App\Application\Dto\Output\External\StoredDocumentOutputDto;
use App\Application\Service\Storage\DocumentStorageInterface;
use Symfony\Component\Filesystem\Filesystem;

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

        if (empty($inputDto->pdfContent)) {
            throw new \RuntimeException('Le contenu PDF est vide.');
        }

        if ($this->isValidBase64($inputDto->pdfContent)) {
            $binaryContent = base64_decode($inputDto->pdfContent);
        } else {
            $binaryContent = $inputDto->pdfContent; // binaire pur
        }

        // Sauvegarde le fichier
        $this->filesystem->dumpFile($fullPath, $binaryContent);

        // Récupère la taille du fichier
        $length = (string) strlen($binaryContent);

        // Construit l'URL publique si exposée via nginx ou autre
        $url = $this->publicUrlPrefix . '/document_' . $inputDto->id . '.pdf';

        return new StoredDocumentOutputDto(
            filename: '/document_' . $inputDto->id . '.pdf',
            path: $fullPath,
            url: $url,
            length: $length
        );
    }

    private function isValidBase64(string $data): bool
    {
        $decoded = base64_decode($data, true);

        return false !== $decoded && base64_encode($decoded) === $data;
    }
}
