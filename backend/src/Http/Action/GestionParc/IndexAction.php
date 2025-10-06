<?php

declare(strict_types=1);

namespace App\Http\Action\GestionParc;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\GestionParc\IndexUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/parc', name: 'gestionparc_index', methods: ['GET'])]
final class IndexAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly IndexUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $output = $this->useCase->execute();
    return $this->responder->respond($output);
  }
}
