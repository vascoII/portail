<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Security\CreateUseCase;
use App\Application\Dto\Input\Security\CreateInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/security/create', name: 'security_create', methods: ['POST'])]
final class CreateAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly CreateUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new CreateInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
