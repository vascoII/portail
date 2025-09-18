<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Occupant\ShowUseCase;
use App\Application\Dto\Input\Occupant\ShowUseInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/occupant', name: 'occupant_show', methods: ['GET'])]
final class ShowAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ShowUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new ShowUseInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
