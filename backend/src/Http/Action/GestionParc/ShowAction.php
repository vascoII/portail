<?php

declare(strict_types=1);

namespace App\Http\Action\GestionParc;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\GestionParc\ShowUseCase;
use App\Application\Factory\GestionParc\GestionParcInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/gestionParc/{pkImmeuble}', name: 'gestionparc_show', methods: ['GET'])]
final class ShowAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ShowUseCase $useCase,
    private readonly GestionParcInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createShowFromRoute($request, self::PARAM_PK_IMMEUBLE);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
