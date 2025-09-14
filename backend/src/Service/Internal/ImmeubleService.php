<?php

namespace App\Service\Internal;

use App\Dto\ImmeubleDto;
use App\Entity\Immeuble;
use App\Service\EntityToDtoTransformer;
use App\Repository\ImmeubleRepository;
use App\Repository\ImmeubleIndicatorRepository;
use App\Service\ImmeubleProviderInterface;

class ImmeubleService implements ImmeubleProviderInterface
{
  public function __construct(
    private ImmeubleRepository $immeubleRepository,
    private ImmeubleIndicatorRepository $indicatorRepository,
    private EntityToDtoTransformer $transformer
  ) {}

  /**
   * Récupère un immeuble et ses indicateurs (data dure + data molle)
   */
  public function getImmeubleById(int $id): ?ImmeubleDto
  {
    return $this->getFakeImmeubleById($id);
    /**
    $immeuble = $this->immeubleRepository->findOneById($id);
    if (!$immeuble) {
      return null;
    }

    return $this->transformer->transformImmeuble($immeuble, true);
     */
  }

  /**
   * Récupère seulement les indicateurs (lazy load async)
   */
  public function getIndicatorsByImmeubleId(int $immeubleId): array
  {
    $indicators = $this->indicatorRepository->findByImmeubleId($immeubleId);

    return array_map(
      fn($indicator) => $this->transformer->transformIndicator($indicator),
      $indicators
    );
  }

  /**
   * Simule la demande de génération de document (via queue plus tard)
   */
  public function requestPdfGeneration(int $immeubleId): bool
  {
    // TODO: envoyer un job dans une queue (ex: RabbitMQ, Redis, ou fake SOAP)
    return true;
  }

  /**
   * Simule une mise à jour vers l’ERP (via SOAP/queue)
   */
  public function syncWithErp(int $immeubleId, array $data): bool
  {
    // TODO: appel SOAP ou mise en queue pour synchro ERP
    return true;
  }

  private function getFakeImmeubleById(int $immeubleId): ImmeubleDto
  {
    return new ImmeubleDto(
      id: $immeubleId,
      name: "Résidence Les Tilleuls",
      address: "12 rue des Fleurs, Paris",
      numApartments: 24,
    );
  }
}
