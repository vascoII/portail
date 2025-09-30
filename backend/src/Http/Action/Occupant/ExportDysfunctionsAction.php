<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Occupant\DysfunctionsUseCase;
use App\Application\Dto\Input\Occupant\DysfunctionsInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/occupant/dysfonctionnements/export', name: 'occupant_export_dysfunctions', methods: ['GET'])]
final class ExportDysfunctionsAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly DysfunctionsUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new DysfunctionsInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
