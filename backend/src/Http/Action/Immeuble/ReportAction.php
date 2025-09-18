<?php

declare(strict_types=1);

namespace App\Http\Action\Immeuble;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Immeuble\ReportUseCase;
use App\Application\Dto\Input\Immeuble\ReportInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/immeuble/{pkImmeuble}/report/{type}/{energie}', name: 'immeuble_report', methods: ['GET'])]
final class ReportAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ReportUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = (string) $request->attributes->get('pkImmeuble');
    $type = (string) $request->attributes->get('type');
    $energie = (string) $request->attributes->get('energie');
    $input = new ReportInputDto($pkImmeuble, $type, $energie);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
