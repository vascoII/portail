<?php

declare(strict_types=1);

namespace App\Application\Factory\ReportToken;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\ReportToken\ReportInputDto;

final class ReportTokenInputFactory
{
  // Methods for query parameters
  public function createReportFromRequest(Request $request): ReportInputDto
  {
    return new ReportInputDto((string) $request->query->get('token'));
  }

  // Methods for route parameters
  public function createReportFromRoute(Request $request, string $tokenParam): ReportInputDto
  {
    $token = (string) $request->attributes->get($tokenParam);
    return new ReportInputDto($token);
  }
}
