<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Logement\LeaksUseCase;
use App\Application\Factory\Logement\LogementInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/logement/{pkLogement}/fuites/export', name: 'logement_export_leaks', methods: ['GET'])]
final class ExportLeaksAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly LeaksUseCase $useCase,
    private readonly LogementInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createLeaksFromRoute($request, self::PARAM_PK_LOGEMENT);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
