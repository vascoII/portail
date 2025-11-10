<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Publisher;

use App\Application\Dto\Output\External\StoredDocumentOutputDto;
use App\Application\Service\Publisher\PublisherInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

final class MercurePublisher implements PublisherInterface
{
    public function __construct(private readonly HubInterface $hub) {}

    public function publish(StoredDocumentOutputDto $dto): void
    {
        $topic = '/document/' . $dto->filename; // ou '/document/' . $dto->id

        $data = json_encode([
            'id' => $dto->filename,
            'url' => $dto->url,
            'length' => $dto->length,
        ]);

        $update = new Update(
            $topic,
            $data,
            private: false // ou true si on veut restreindre l'accès
        );

        $this->hub->publish($update);
    }
}
