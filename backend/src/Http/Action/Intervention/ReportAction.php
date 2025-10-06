<?php

declare(strict_types=1);

namespace App\Http\Action\Intervention;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Intervention\ReportUseCase;
use App\Application\Factory\Shared\SharedInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/intervention/{pkDepannage}/report', name: 'intervention_report', methods: ['GET'])]
final class ReportAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ReportUseCase $useCase,
    private readonly SharedInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createGetReportFromRouteWithCustomParams($request, self::INTERVENTION, self::PARAM_PK_DEPANNAGE, "WORKORDERNUMBER");
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
