<?php

declare(strict_types=1);

namespace App\Http\Action\Document\Excel;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Document\GenerateLogementDysfonctionnementsExcelUseCase;
use App\Application\Factory\Shared\SharedInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/document/dysfonctionnements_logement/{id}/generate', name: 'dysfonctionnements_logement_generate', methods: ['GET'])]
final class GenerateLogementDysfonctionnementsExcelAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GenerateLogementDysfonctionnementsExcelUseCase $useCase,
    private readonly SharedInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createIdStringFromRoute($request);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
