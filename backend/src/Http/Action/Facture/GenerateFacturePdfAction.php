<?php

declare(strict_types=1);

namespace App\Http\Action\Facture;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Facture\GenerateFacturePdfUseCase;
use App\Application\Factory\Shared\SharedInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/facture/{pkFacture}/generate', name: 'facture_generate', methods: ['GET'])]
final class GenerateFacturePdfAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GenerateFacturePdfUseCase $useCase,
    private readonly SharedInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createGetReportFromRouteWithCustomParams($request, self::FACTURE, self::PARAM_PK_FACTURE, "PKFACTURE");
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
