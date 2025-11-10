<?php

declare(strict_types=1);

namespace App\Application\Factory\Document;

use App\Application\Dto\Input\Document\GenerateAnomaliesDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateDysfonctionnementsDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateFactureDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateFuitesDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleDetailByImmeubleDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleDetailDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleReleveDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleSyntheseByImmeubleDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleSyntheseDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateInterventionDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateInterventionsDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateLogementRepartDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateOccupantNoteDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateOccupantReleveDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateOccupantRepartDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateReportByTokenDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateReportDocumentInputDto;
use App\Application\Validator\Input\Document\Excel\GenerateExcelInputValidator;
use App\Application\Validator\Input\Document\Pdf\GeneratePdfInputValidator;
use Symfony\Component\HttpFoundation\Request;

final class DocumentInputFactory
{
    private array $data;

    public function __construct(
        private readonly GenerateExcelInputValidator $excelValidator,
        private readonly GeneratePdfInputValidator $pdfValidator
    ) {}

    public function createAnomaliesFromRequest(Request $request): GenerateAnomaliesDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToExcelValidationFormat($this->data);
        $this->excelValidator->validateGenerateAnomaliesExcelInput($validationData);

        $immeubleId = $this->getInt('immeubleId');
        $logementId = $this->getInt('logementId', null);
        $occupantId = $this->getInt('occupantId', null);
        $appareilId = $this->getInt('appareilId', null);

        return new GenerateAnomaliesDocumentInputDto($immeubleId, $logementId, $occupantId, $appareilId);
    }

    public function createDocumentContentFromRequest(Request $request): GenerateReportDocumentInputDto
    {
        $this->getData($request);

        $id = $this->getInt('id');
        $pdfContent = $this->getContent('content');

        return new GenerateReportDocumentInputDto($id, $pdfContent);
    }

    public function createDysfonctionnementsFromRequest(Request $request): GenerateDysfonctionnementsDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToExcelValidationFormat($this->data);
        $this->excelValidator->validateGenerateDysfonctionnementsExcelInput($validationData);

        $immeubleId = $this->getInt('immeubleId');
        $logementId = $this->getInt('logementId', null);
        $occupantId = $this->getInt('occupantId', null);

        return new GenerateDysfonctionnementsDocumentInputDto($immeubleId, $logementId, $occupantId);
    }

    public function createFactureFromRequest(Request $request): GenerateFactureDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToPdfValidationFormat($this->data);
        $this->pdfValidator->validateGenerateFacturePdfInput($validationData);

        $factureId = $this->getInt('factureId');

        return new GenerateFactureDocumentInputDto($factureId);
    }

    public function createFuitesFromRequest(Request $request): GenerateFuitesDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToExcelValidationFormat($this->data);
        $this->excelValidator->validateGenerateFuitesExcelInput($validationData);

        $immeubleId = $this->getInt('immeubleId');
        $logementId = $this->getInt('logementId', null);
        $occupantId = $this->getInt('occupantId', null);
        $appareilId = $this->getInt('appareilId', null);

        return new GenerateFuitesDocumentInputDto($immeubleId, $logementId, $occupantId, $appareilId);
    }

    public function createImmeubleDetailFromRequest(Request $request): GenerateImmeubleDetailByImmeubleDocumentInputDto|GenerateImmeubleDetailDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToPdfValidationFormat($this->data);
        $this->pdfValidator->validateGenerateImmeubleDetailPdfInput($validationData);

        $immeubleId = $this->getInt('immeubleId');
        $date1 = $this->getString('date1');
        $date2 = $this->getString('date2');

        return is_null($immeubleId)
            ? new GenerateImmeubleDetailDocumentInputDto((string) $date1, (string) $date2)
            : new GenerateImmeubleDetailByImmeubleDocumentInputDto((int) $immeubleId, (string) $date1, (string) $date2);
    }

    public function createImmeubleInterventionsFromRequest(Request $request): GenerateInterventionsDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToExcelValidationFormat($this->data);
        $this->excelValidator->validateGenerateImmeubleInterventionsExcel($validationData);

        $immeubleId = $this->getInt('immeubleId');
        $logementId = $this->getInt('logementId', null);
        $occupantId = $this->getInt('occupantId', null);

        return new GenerateInterventionsDocumentInputDto($immeubleId, $logementId, $occupantId, null, null);
    }

    public function createImmeubleReleveFromRequest(Request $request): GenerateImmeubleReleveDocumentInputDto
    {
        $this->getData($request);

        $releveId = $this->getInt('releveId');

        return new GenerateImmeubleReleveDocumentInputDto($releveId);
    }

    public function createImmeubleSyntheseFromRequest(Request $request): GenerateImmeubleSyntheseByImmeubleDocumentInputDto|GenerateImmeubleSyntheseDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $date1 = $this->getString('date1');
        $date2 = $this->getString('date2');

        return is_null($immeubleId)
            ? new GenerateImmeubleSyntheseDocumentInputDto((string) $date1, (string) $date2)
            : new GenerateImmeubleSyntheseByImmeubleDocumentInputDto($immeubleId, (string) $date1, (string) $date2);
    }

    public function createInterventionFromRequest(Request $request): GenerateInterventionDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToPdfValidationFormat($this->data);
        $this->pdfValidator->validateGenerateInterventionPdfInput($validationData);

        $workOrderId = $this->getInt('workOrderId');

        return new GenerateInterventionDocumentInputDto(
            (string) $workOrderId
        );
    }

    public function createInterventionsFromRequest(Request $request): GenerateInterventionsDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToExcelValidationFormat($this->data);
        $this->excelValidator->validateGenerateInterventionsExcelInput($validationData);

        $immeubleId = $this->getInt('immeubleId');
        $date1 = $this->getString('date1', null);
        $date2 = $this->getString('date2', null);

        return new GenerateInterventionsDocumentInputDto(
            $immeubleId,
            null,
            null,
            (string) $date1,
            (string) $date2
        );
    }

    public function createLogementRepartFromRequest(Request $request): GenerateLogementRepartDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToPdfValidationFormat($this->data);
        $this->pdfValidator->validateGenerateLogementRepartPdfInput($validationData);

        $immeubleId = $this->getInt('immeubleId');
        $logementId = $this->getInt('logementId');

        return new GenerateLogementRepartDocumentInputDto($immeubleId, $logementId);
    }

    public function createOccupantNoteFromRequest(Request $request): GenerateOccupantNoteDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToPdfValidationFormat($this->data);
        $this->pdfValidator->validateGenerateOccupantNotePdfInput($validationData);

        $immeubleId = $this->getInt('immeubleId');
        $occupantId = $this->getInt('occupantId');
        $typeErc = $this->getString('typeErc');

        return new GenerateOccupantNoteDocumentInputDto($occupantId, $immeubleId, (string) $typeErc);
    }

    public function createOccupantReleveFromRequest(Request $request): GenerateOccupantReleveDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToPdfValidationFormat($this->data);
        $this->pdfValidator->validateGenerateOccupantRelevePdfInput($validationData);

        $occupantId = $this->getInt('occupantId');

        return new GenerateOccupantReleveDocumentInputDto($occupantId);
    }

    public function createOccupantRepartFromRequest(Request $request): GenerateOccupantRepartDocumentInputDto
    {
        $this->getData($request);
        $validationData = $this->convertToPdfValidationFormat($this->data);
        $this->pdfValidator->validateGenerateOccupantRepartPdfInput($validationData);

        $immeubleId = $this->getInt('immeubleId');
        $occupantId = $this->getInt('occupantId');

        return new GenerateOccupantRepartDocumentInputDto($immeubleId, $occupantId);
    }

    public function createReportByTokenFromRequest(Request $request): GenerateReportByTokenDocumentInputDto
    {
        return new GenerateReportByTokenDocumentInputDto(
            (string) $request->attributes->get('tokenId')
        );
    }

    private function convertToExcelValidationFormat(array $data): array
    {
        $converted = [];
        if (isset($data['immeubleId'])) {
            $converted['pkImmeuble'] = $data['immeubleId'];
        }
        if (isset($data['logementId'])) {
            $converted['pkLogement'] = $data['logementId'];
        }
        if (isset($data['occupantId'])) {
            $converted['pkOccupant'] = $data['occupantId'];
        }
        if (isset($data['appareilId'])) {
            $converted['pkAppareil'] = $data['appareilId'];
        }
        if (isset($data['date1'])) {
            $converted['date1'] = $data['date1'];
        }
        if (isset($data['date2'])) {
            $converted['date2'] = $data['date2'];
        }

        return $converted;
    }

    private function convertToPdfValidationFormat(array $data): array
    {
        $converted = [];
        if (isset($data['factureId'])) {
            $converted['pkFacture'] = $data['factureId'];
        }
        if (isset($data['immeubleId'])) {
            $converted['pkImmeuble'] = $data['immeubleId'];
        }
        if (isset($data['logementId'])) {
            $converted['pkLogement'] = $data['logementId'];
        }
        if (isset($data['occupantId'])) {
            $converted['pkOccupant'] = $data['occupantId'];
        }
        if (isset($data['workOrderId'])) {
            $converted['workOrderNumber'] = (string) $data['workOrderId'];
        }
        if (isset($data['typeErc'])) {
            $converted['typeEnergie'] = $data['typeErc'];
        }
        if (isset($data['date1'])) {
            $converted['date1'] = $data['date1'];
        }
        if (isset($data['date2'])) {
            $converted['date2'] = $data['date2'];
        }

        return $converted;
    }

    private function getContent(mixed $content): mixed
    {
        return array_key_exists($content, $this->data) && null !== $this->data[$content]
            ? $this->data[$content]
            : null;
    }

    private function getData(Request $request): void
    {
        $raw = (string) $request->getContent();
        $this->data = json_decode($raw, true);

        if (! is_array($this->data)) {
            $this->data = [];
        }
    }

    private function getInt(string $key): ?int
    {
        return array_key_exists($key, $this->data) && null !== $this->data[$key]
            ? (int) $this->data[$key]
            : null;
    }

    private function getString(string $key, ?string $default = ''): ?string
    {
        return array_key_exists($key, $this->data) && null !== $this->data[$key]
            ? (string) $this->data[$key]
            : $default;
    }
}
