<?php

declare(strict_types=1);

namespace App\Http\Action\Operator;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Operator\ViewUseCase;
use App\Application\Dto\Input\Operator\ViewInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/gestionnaire/{id}', name: 'operator_view', methods: ['GET'])]
final class ViewAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ViewUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $id = (string) $request->attributes->get('id');
    $input = new ViewInputDto($id);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
