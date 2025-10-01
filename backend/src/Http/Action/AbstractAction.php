<?php

declare(strict_types=1);

namespace App\Http\Action;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractAction implements ActionInterface
{
  public const PARAM_PK_LOGEMENT = 'pkLogement';
  public const PARAM_PK_IMMEUBLE = 'pkImmeuble';
  public const PARAM_PK_OCCUPANT = 'pkOccupant';
  public const PARAM_PK_INTERVENTION = 'pkIntervention';
  public const PARAM_PK_DEPANNAGE = 'pkDepannage';
  public const PARAM_PK_FACTURE = 'pkFacture';
  public const PARAM_PK_TICKET = 'pkTicket';
  public const PARAM_TYPE = 'type';
  public const PARAM_ENERGIE = 'energie';
  public const PARAM_TOKEN = 'token';
  public const PARAM_ID = 'id';

  public const FACTURE = 'FACTURE';

  protected function json(mixed $data, int $status = Response::HTTP_OK, array $headers = []): JsonResponse
  {
    return new JsonResponse($data, $status, $headers);
  }

  /**
   * Helper method to create API route path with /api prefix
   */
  protected static function apiPath(string $path): string
  {
    return '/api' . $path;
  }
}
