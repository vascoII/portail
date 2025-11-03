<?php

declare(strict_types=1);

namespace App\Http\Action\External\Suivi;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/suivi/workorders', name: 'external_workorder_list', methods: ['POST'])]
final class ListWorkOrdersAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $data = json_decode($request->getContent(), true);

        if (! is_array($data) || ! isset($data['caseId']) || ! isset($data['email'])) {
            return new JsonResponse(['error' => 'Invalid payload'], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['status' => 'OK'], Response::HTTP_OK);
    }
}
