<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Occupant\AnomaliesUseCase;
use App\Application\Dto\Input\Occupant\AnomaliesInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/occupant/anomalies', name: 'occupant_list_anomalies', methods: ['GET'])]
final class ListAnomaliesAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly AnomaliesUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new AnomaliesInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
