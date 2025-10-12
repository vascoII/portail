<?php

declare(strict_types=1);

namespace App\Http\Action\Immeuble;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Immeuble\ListLogementsByImmeubleUseCase;
use App\Application\Factory\Shared\SharedInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/immeuble/{immeubleId}/logements', name: 'immeuble_logements_list', methods: ['GET'])]
final class ListLogementsByImmeubleAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ListLogementsByImmeubleUseCase $useCase,
    private readonly SharedInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->getIdIntFromRoute($request);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
