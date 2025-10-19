<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use App\Application\Dto\Output\Operator\GetOperatorOutputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\Transformer\OperatorTransformerInterface;
use App\Application\Factory\Shared\SharedEntityFactory;
use App\Application\Factory\Operator\OperatorOutputFactory;

final class OperatorTransformer implements OperatorTransformerInterface
{
   public function __construct(
      private readonly SharedEntityFactory $entityFactory,
      private readonly OperatorOutputFactory $outputFactory
   ) {}

   /**
    * Transform raw response to ListOperatorsOutputDto
    */
   public function transformListOperators(object $dataSourceResult): ListOperatorsOutputDto
   {
      $operatorsRaw = is_array($rawUser = $dataSourceResult->ListeUsers->user ?? null) ?
         $rawUser : ($rawUser ? [$rawUser] : []);

      $entities = $this->entityFactory->createManyUsersFromRawList($operatorsRaw);

      return $this->outputFactory->createListOperators($entities);
   }

   public function transformGetOperator(object $dataSourceResult): GetOperatorOutputDto
   {
      $entity = $this->entityFactory->createUserFromRaw($dataSourceResult);
      return $this->outputFactory->createGetOperator($entity);
   }

   public function transformGetOperatorStat(object $dataSourceResult): SuccessOutputDto
   {
      // TODO: Transform actual response when SOAP method is known
      return new SuccessOutputDto(true);
   }

   public function transformCreateOperationImmeuble(object $dataSourceResult): SuccessOutputDto
   {
      // TODO: Transform actual response when SOAP method is known
      return new SuccessOutputDto(true);
   }

   public function transformPatchOperatorImmeuble(object $dataSourceResult): SuccessOutputDto
   {
      // TODO: Transform actual response when SOAP method is known
      return new SuccessOutputDto(true);
   }
}
