<?php

namespace App\Controller;

use App\UseCase\SyncWithErpUseCase;
use App\UseCase\RequestPdfGenerationUseCase;
use App\UseCase\GetIndicatorsByImmeubleIdUseCase;
use App\UseCase\GetImmeubleByIdUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ImmeubleController
{
  public function __construct(
    private SyncWithErpUseCase $syncWithErpUseCase,
    private RequestPdfGenerationUseCase $requestPdfGenerationUseCase,
    private GetIndicatorsByImmeubleIdUseCase $getIndicatorsByImmeubleIdUseCase,
    private GetImmeubleByIdUseCase $getImmeubleByIdUseCase
  ) {}

  /**
   * GET /api/immeubles/{id}
   * Retourne les données "dures" d'un immeuble (sans indicateurs)
   */
  #[Route('/api/immeubles/{id}', name: 'get_immeuble_by_id', methods: ['GET'])]
  public function getImmeubleById(int $id): JsonResponse
  {
    $dto = $this->getImmeubleByIdUseCase->execute($id);
    if (!$dto) {
      return new JsonResponse(['error' => 'Immeuble not found'], 404);
    }

    return new JsonResponse($dto);
  }

  /**
   * GET /api/immeubles/{id}/indicators
   * Retourne les indicateurs "mous" (async)
   */
  #[Route('/api/immeubles/{id}/indicators', name: 'get_immeuble_indicators', methods: ['GET'])]
  public function getIndicatorsByImmeubleId(int $id): JsonResponse
  {
    $dtos = $this->getIndicatorsByImmeubleIdUseCase->execute($id);

    return new JsonResponse($dtos);
  }

  /**
   * POST /api/immeubles/{id}/pdf
   * Simule une demande de génération de PDF (via queue)
   */
  #[Route('/api/immeubles/{id}/pdf', name: 'request_immeuble_pdf', methods: ['POST'])]
  public function requestPdfGeneration(int $id): JsonResponse
  {
    $success = $this->requestPdfGenerationUseCase->execute($id);

    return new JsonResponse(['success' => $success]);
  }

  /**
   * POST /api/immeubles/{id}/sync
   * Simule une synchro avec l’ERP
   */
  #[Route('/api/immeubles/{id}/sync', name: 'sync_immeuble_erp', methods: ['POST'])]
  public function syncWithErp(int $id, Request $request): JsonResponse
  {
    $data = json_decode($request->getContent(), true) ?? [];
    $success = $this->syncWithErpUseCase->execute($id, $data);

    return new JsonResponse(['success' => $success]);
  }
}
