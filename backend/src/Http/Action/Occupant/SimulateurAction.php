<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Occupant\SimulateurUseCase;
use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/occupant/simulateur', name: 'occupant_simulateur', methods: ['GET'])]
final class SimulateurAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly SimulateurUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new SimulateurInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
