<?php

declare(strict_types=1);

namespace App\Http\Action\Intervention;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Intervention\ReportUseCase;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/intervention/{pkDepannage}/report', name: 'intervention_report', methods: ['GET'])]
final class ReportAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ReportUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkDepannage = (string) $request->attributes->get(self::PARAM_PK_DEPANNAGE);
    $input = new GetReportInputDto(self::INTERVENTION, "WORKORDERNUMBER=$pkDepannage");
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
