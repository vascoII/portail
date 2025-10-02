<?php

declare(strict_types=1);

namespace App\Http\Action\Operator;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Operator\RemoveBuildingUseCase;
use App\Application\Dto\Input\Operator\RemoveBuildingInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/gestionnaire/{id}/immeuble/supprimer', name: 'operator_remove_building', methods: ['POST'])]
final class RemoveBuildingAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly RemoveBuildingUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $id = (string) $request->attributes->get(self::PARAM_ID);
    $input = new RemoveBuildingInputDto($id);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
