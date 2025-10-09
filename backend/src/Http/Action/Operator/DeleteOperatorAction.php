<?php

declare(strict_types=1);

namespace App\Http\Action\Operator;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Operator\DeleteUseCase;
use App\Application\Factory\Operator\OperatorInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/operator/{id}', name: 'operator_delete', methods: ['DELETE'])]
final class DeleteOperatorAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder, 
    private readonly DeleteUseCase $useCase,
    private readonly OperatorInputFactory $inputFactory  
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->getOperatorFromRoute($request);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
