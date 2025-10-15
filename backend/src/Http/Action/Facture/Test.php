<?php

declare(strict_types=1);

namespace App\Http\Action\Facture;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Facture\ListFacturesUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/debug-token', name: 'debug_token', methods: ['GET'])]
final class Test
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ListFacturesUseCase $useCase
  ) {}

  
public function debugToken(Request $request): JsonResponse
{
    return new JsonResponse([
        'Authorization' => $request->headers->get('Authorization'),
    ]);
}

}
