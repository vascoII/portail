<?php

declare(strict_types=1);

namespace App\Http\Action\Operator;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Operator\ViewUseCase;
use App\Application\Factory\Operator\OperatorInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/gestionnaire/{id}', name: 'operator_view', methods: ['GET'])]
final class ViewAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ViewUseCase $useCase,
    private readonly OperatorInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createViewFromRoute($request, self::PARAM_ID);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
