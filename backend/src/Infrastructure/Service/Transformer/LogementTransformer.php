<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Logement\ListLogementsOutputDto;
use App\Application\Dto\Output\Logement\GetLogementOutputDto;
use App\Application\Service\Transformer\LogementTransformerInterface;
use App\Application\Factory\Logement\LogementEntityFactory;
use App\Application\Factory\Logement\LogementOutputFactory;
use App\Application\Dto\Output\Logement\ListLogementsOuputDto;

final class LogementTransformer implements LogementTransformerInterface
{
   public function __construct(
      private readonly LogementEntityFactory $entityFactory,
      private readonly LogementOutputFactory $outputFactory
   ) {}

   /**
    * Transform raw response to ListLogementsOutputDto
    */
   public function transformListLogements(object $dataSourceResult): ListLogementsOutputDto
   {
      $logementsRaw = is_array($rawLogement = $dataSourceResult->ListeInfosLogements->infosLogement ?? null) ?
         $rawLogement : ($rawLogement ? [$rawLogement] : []);

      $entities = $this->entityFactory->createManyLogementsFromRawList($logementsRaw);

      return $this->outputFactory->createListLogements($entities);
   }

   public function transformGetLogement(object $dataSourceResult): GetLogementOutputDto
   {
      $entity = $this->entityFactory->createLogementFromRaw($dataSourceResult);
      return $this->outputFactory->createGetLogement($entity);
   }
}
