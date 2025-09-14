<?php

namespace App\Service\External;

use App\Service\EntityToDtoTransformer;
use App\Service\ImmeubleSoapProviderInterface;
use App\Service\External\FakeSoapClient;

class ImmeubleSoapService implements ImmeubleSoapProviderInterface
{
  public function __construct(
    private EntityToDtoTransformer $transformer,
    private FakeSoapClient $soapClient
  ) {}

  /**
   * Récupère seulement les indicateurs (lazy load async)
   */
  public function getIndicatorsByImmeubleId(int $immeubleId): array
  {
    $indicators = $this->soapClient->getIndicatorsByImmeubleId($immeubleId);
    return $indicators;
    /**     return array_map(
      fn($indicator) => $this->transformer->transformIndicator($indicator),
      $indicators
    );
     */
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
}
