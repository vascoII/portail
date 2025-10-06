<?php

declare(strict_types=1);

namespace App\Http\Action\ReportToken;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\ReportToken\ReportUseCase;
use App\Application\Factory\ReportToken\ReportTokenInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/report-token/{token}', name: 'report_token_report', methods: ['GET'])]
final class ReportAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ReportUseCase $useCase,
    private readonly ReportTokenInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createReportFromRoute($request, self::PARAM_TOKEN);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
