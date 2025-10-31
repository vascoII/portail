<?php

declare(strict_types=1);

namespace App\Http\Responder;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ExcelResponder implements ResponderInterface
{
    public function __construct(
        private readonly LoggerInterface $httpLogger
    ) {}

    public function respond(mixed $payload, int $status = Response::HTTP_OK, array $headers = []): Response
    {
        $startTime = microtime(true);

        $response = new Response($payload->content, $status, $headers);

        // Headers spécifiques pour le téléchargement Excel
        $response->headers->set('Content-Type', $payload->mimeType);
        $response->headers->set('Content-Disposition', 'attachment; filename=' . $payload->filename);
        $response->headers->set('Content-Transfer-Encoding', 'binary');
        $response->headers->set('Expires', '0');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Content-Length', (string) $payload->length);

        // Ajout de l'ID de requête si disponible
        $request = $this->getCurrentRequest();
        if ($request && $request->attributes->has('request_id')) {
            $response->headers->set('X-Request-ID', $request->attributes->get('request_id'));
        }

        $duration = (microtime(true) - $startTime) * 1000;

        $this->httpLogger->debug('Excel response prepared', [
            'status_code' => $status,
            'duration_ms' => round($duration, 2),
            'response_size' => $payload->length,
            'filename' => $payload->filename,
            'headers' => array_keys($headers),
        ]);

        return $response;
    }

    private function getCurrentRequest(): ?Request
    {
        return Request::createFromGlobals(); // Option à améliorer avec RequestStack si besoin
    }
}
