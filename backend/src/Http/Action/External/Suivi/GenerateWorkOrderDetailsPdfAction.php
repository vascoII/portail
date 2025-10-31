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
#[Route(path: '/suivi/workorder/{id}/pdf', name: 'document_workorder_pdf', methods: ['GET'])]
final class GenerateWorkOrderDetailsPdfAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $id = $request->attributes->get('id') ?? null;

        if (is_null($id)) {
            return new JsonResponse(['error' => 'Invalid payload'], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['status' => 'OK'], Response::HTTP_OK);
    }
}
