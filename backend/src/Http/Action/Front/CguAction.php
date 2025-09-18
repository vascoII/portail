<?php

declare(strict_types=1);

namespace App\Http\Action\Front;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Front\CguUseCase;
use App\Application\Dto\Input\Front\CguInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/front/cgu', name: 'front_cgu', methods: ['GET'])]
final class CguAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly CguUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new CguInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
