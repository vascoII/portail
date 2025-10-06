<?php

declare(strict_types=1);

namespace App\Http\Action\Immeuble;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Immeuble\ReportUseCase;
use App\Application\Factory\Immeuble\ImmeubleInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/immeuble/{pkImmeuble}/report/{type}/{energie}', name: 'immeuble_report', methods: ['GET'])]
final class ReportAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ReportUseCase $useCase,
    private readonly ImmeubleInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createReportFromRoute($request, self::PARAM_PK_IMMEUBLE, self::PARAM_TYPE, self::PARAM_ENERGIE);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
