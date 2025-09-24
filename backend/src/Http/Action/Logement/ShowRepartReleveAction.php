<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Logement\ShowRepartReleveUseCase;
use App\Application\Dto\Input\Logement\ShowRepartReleveInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/logements/{pkImmeuble}/logement/{pkLogement}/releve_repart', name: 'logement_repart_releve', methods: ['GET'])]
final class ShowRepartReleveAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ShowRepartReleveUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = (string) $request->attributes->get(self::PARAM_PK_IMMEUBLE);
    $pkLogement = (string) $request->attributes->get(self::PARAM_PK_LOGEMENT);
    $input = new ShowRepartReleveInputDto($pkImmeuble, $pkLogement);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
