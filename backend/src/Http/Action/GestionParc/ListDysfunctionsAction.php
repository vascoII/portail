<?php

declare(strict_types=1);

namespace App\Http\Action\GestionParc;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\GestionParc\DysfunctionsUseCase;
use App\Application\Factory\GestionParc\GestionParcInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/gestionParc/{pkImmeuble}/dysfonctionnements', name: 'gestionparc_list_dysfunctions', methods: ['GET'])]
final class ListDysfunctionsAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly DysfunctionsUseCase $useCase,
    private readonly GestionParcInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createDysfunctionsFromRoute($request, self::PARAM_PK_IMMEUBLE);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
