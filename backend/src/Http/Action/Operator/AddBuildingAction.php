<?php

declare(strict_types=1);

namespace App\Http\Action\Operator;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Operator\AddBuildingUseCase;
use App\Application\Dto\Input\Operator\AddBuildingInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/gestionnaire/{id}/immeuble/ajouter', name: 'operator_add_building', methods: ['POST'])]
final class AddBuildingAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly AddBuildingUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $id = (string) $request->attributes->get('id');
    $input = new AddBuildingInputDto($id);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
