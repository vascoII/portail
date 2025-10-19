<?php

declare(strict_types=1);

namespace App\Http\Action\Parc;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Parc\GetParcIndicatorsUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/parc_indicators', name: 'parc_indicators_get', methods: ['GET'])]
final class GetParcIndicatorsAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GetParcIndicatorsUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $output = $this->useCase->execute();
    return $this->responder->respond($output);
  }
}
