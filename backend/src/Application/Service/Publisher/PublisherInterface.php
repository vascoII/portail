<?php

declare(strict_types=1);

namespace App\Application\Service\Publisher;

use App\Application\Dto\Output\External\StoredDocumentOutputDto;

interface PublisherInterface
{
    public function publish(StoredDocumentOutputDto $dto): void;
}
