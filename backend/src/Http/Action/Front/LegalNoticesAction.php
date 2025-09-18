<?php

declare(strict_types=1);

namespace App\Http\Action\Front;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Front\LegalNoticesUseCase;
use App\Application\Dto\Input\Front\LegalNoticesInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/front/legal-notices', name: 'front_legal_notices', methods: ['GET'])]
final class LegalNoticesAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly LegalNoticesUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new LegalNoticesInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
