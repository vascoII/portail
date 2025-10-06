<?php

declare(strict_types=1);

namespace App\Http\Action\Operator;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Operator\DeleteUseCase;
use App\Application\Dto\Input\Operator\DeleteInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/gestionnaire/{id}/supprimer', name: 'operator_delete', methods: ['DELETE'])]
final class DeleteAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly DeleteUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $id = (string) $request->attributes->get(self::PARAM_ID);
    $input = new DeleteInputDto($id);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
