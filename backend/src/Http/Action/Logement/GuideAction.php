<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Logement\GuideUseCase;
use App\Application\Dto\Input\Logement\GuideInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/guide', name: 'logement_guide', methods: ['GET'])]
final class GuideAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly GuideUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new GuideInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
