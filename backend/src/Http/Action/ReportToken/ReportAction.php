<?php

declare(strict_types=1);

namespace App\Http\Action\ReportToken;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\ReportToken\ReportUseCase;
use App\Application\Dto\Input\ReportToken\ReportInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/report-token/{token}', name: 'report_token_report', methods: ['GET'])]
final class ReportAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ReportUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $token = (string) $request->attributes->get(self::PARAM_TOKEN);
    $input = new ReportInputDto($token);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
