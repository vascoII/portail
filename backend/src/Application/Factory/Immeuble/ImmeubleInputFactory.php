<?php

declare(strict_types=1);

namespace App\Application\Factory\Immeuble;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Immeuble\GetInfosAnomaliesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDepannagesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosDysfonctionnementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosFuitesByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosImmeublesInputDto;
use App\Application\Dto\Input\Immeuble\GetInfosLogementsByImmeubleInputDto;
use App\Application\Dto\Input\Immeuble\GetTableauBordImmeubleInputDto;

final class ImmeubleInputFactory
{
  public function createGetInfosAnomaliesByImmeubleFromRequest(Request $request): GetInfosAnomaliesByImmeubleInputDto
  {
    return new GetInfosAnomaliesByImmeubleInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('paramsFiltres')
    );
  }

  public function createGetInfosDepannagesByImmeubleFromRequest(Request $request): GetInfosDepannagesByImmeubleInputDto
  {
    return new GetInfosDepannagesByImmeubleInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('paramsFiltres')
    );
  }

  public function createGetInfosDysfonctionnementsByImmeubleFromRequest(Request $request): GetInfosDysfonctionnementsByImmeubleInputDto
  {
    return new GetInfosDysfonctionnementsByImmeubleInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('paramsFiltres')
    );
  }

  public function createGetInfosFuitesByImmeubleFromRequest(Request $request): GetInfosFuitesByImmeubleInputDto
  {
    return new GetInfosFuitesByImmeubleInputDto(
      (string) $request->query->get('pkImmeuble'),
      (string) $request->query->get('paramsFiltres')
    );
  }

  public function createGetInfosImmeublesFromRequest(Request $request): GetInfosImmeublesInputDto
  {
    return new GetInfosImmeublesInputDto(
      (int) $request->query->get('pkUser'),
      (string) $request->query->get('paramsFiltres'),
      (string) $request->query->get('paramsInfos')
    );
  }

  public function createGetInfosLogementsByImmeubleFromRequest(Request $request): GetInfosLogementsByImmeubleInputDto
  {
    return new GetInfosLogementsByImmeubleInputDto(
      (string) $request->query->get('paramsFiltres'),
      (string) $request->query->get('paramsInfos')
    );
  }

  public function createGetTableauBordImmeubleFromRequest(Request $request): GetTableauBordImmeubleInputDto
  {
    return new GetTableauBordImmeubleInputDto((string) $request->query->get('pkImmeuble'));
  }
}
