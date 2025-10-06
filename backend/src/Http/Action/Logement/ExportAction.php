<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Logement\ExportUseCase;
use App\Application\Factory\Logement\LogementInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/immeuble/{pkImmeuble}/logements/export', name: 'logement_export', methods: ['GET'])]
final class ExportAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ExportUseCase $useCase,
    private readonly LogementInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createExportFromRoute($request, self::PARAM_PK_IMMEUBLE);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
