<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Logement\AnomaliesUseCase;
use App\Application\Factory\Logement\LogementInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/logement/{pkLogement}/anomalies', name: 'logement_list_anomalies', methods: ['GET'])]
final class ListAnomaliesAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly AnomaliesUseCase $useCase,
    private readonly LogementInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createAnomaliesFromRoute($request, self::PARAM_PK_LOGEMENT);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
