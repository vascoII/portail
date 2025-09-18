<?php

declare(strict_types=1);

namespace App\Http\Action\Operator;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Operator\OtatsoccupantsUseCase;
use App\Application\Dto\Input\Operator\OtatsoccupantsInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/gestionnaire/statistiques', name: 'operator_statsoccupants', methods: ['GET'])]
final class OtatsoccupantsAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly OtatsoccupantsUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new OtatsoccupantsInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
