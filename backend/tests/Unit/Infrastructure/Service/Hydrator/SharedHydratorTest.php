<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Service\Hydrator;

use App\Infrastructure\Service\Hydrator\SharedHydrator;
use App\Application\Dto\Input\Shared\GetDetailsDepannageInpuDto;
use App\Application\Dto\Input\Shared\GetExcelInpuDto;
use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Input\Shared\GetReportByTokenInputDto;

class SharedHydratorTest extends BaseHydratorTest
{
  private SharedHydrator $hydrator;
  private string $superLoginID;
  private string $superPassword;
  private string $adminSessionId;

  protected function setUp(): void
  {
    $this->superLoginID = 'super_admin';
    $this->superPassword = 'super_password';
    $this->adminSessionId = 'admin_session_123';
    $this->hydrator = new SharedHydrator(
      $this->superLoginID,
      $this->superPassword,
      $this->adminSessionId
    );
  }

  public function testHydrateGetDetailsDepannage(): void
  {
    // Arrange
    $inputDto = new GetDetailsDepannageInpuDto('123');

    // Act
    $result = $this->hydrator->hydrateGetDetailsDepannage($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'WorkOrderNumber' => 123
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateGetExcel(): void
  {
    // Arrange
    $inputDto = new GetExcelInpuDto('report_type', 'filter_params');

    // Act
    $result = $this->hydrator->hydrateGetExcel($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'ReportType' => 'report_type',
      'ParamsFiltres' => 'filter_params'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetReport(): void
  {
    // Arrange
    $inputDto = new GetReportInputDto('report_type', 'filter_params');

    // Act
    $result = $this->hydrator->hydrateGetReport($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'ReportType' => 'report_type',
      'ParamsFiltres' => 'filter_params'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 2);
  }

  public function testHydrateGetReportByToken(): void
  {
    // Arrange
    $inputDto = new GetReportByTokenInputDto('token_123');

    // Act
    $result = $this->hydrator->hydrateGetReportByToken($inputDto);

    // Assert
    $this->assertHydratedObjectType($result);
    $this->assertHydratedObjectHasProperties($result, [
      'token' => 'token_123'
    ]);
    $this->assertHydratedObjectPropertyCount($result, 1);
  }

  public function testHydrateGetDetailsDepannageWithDifferentIds(): void
  {
    // Arrange
    $inputDto1 = new GetDetailsDepannageInpuDto('123');
    $inputDto2 = new GetDetailsDepannageInpuDto('456');
    $inputDto3 = new GetDetailsDepannageInpuDto('789');

    // Act
    $result1 = $this->hydrator->hydrateGetDetailsDepannage($inputDto1);
    $result2 = $this->hydrator->hydrateGetDetailsDepannage($inputDto2);
    $result3 = $this->hydrator->hydrateGetDetailsDepannage($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, ['WorkOrderNumber' => 123]);
    $this->assertHydratedObjectHasProperties($result2, ['WorkOrderNumber' => 456]);
    $this->assertHydratedObjectHasProperties($result3, ['WorkOrderNumber' => 789]);
  }

  public function testHydrateGetExcelWithDifferentData(): void
  {
    // Arrange
    $inputDto1 = new GetExcelInpuDto('type1', 'params1');
    $inputDto2 = new GetExcelInpuDto('type2', 'params2');
    $inputDto3 = new GetExcelInpuDto('type3', 'params3');

    // Act
    $result1 = $this->hydrator->hydrateGetExcel($inputDto1);
    $result2 = $this->hydrator->hydrateGetExcel($inputDto2);
    $result3 = $this->hydrator->hydrateGetExcel($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, [
      'ReportType' => 'type1',
      'ParamsFiltres' => 'params1'
    ]);
    $this->assertHydratedObjectHasProperties($result2, [
      'ReportType' => 'type2',
      'ParamsFiltres' => 'params2'
    ]);
    $this->assertHydratedObjectHasProperties($result3, [
      'ReportType' => 'type3',
      'ParamsFiltres' => 'params3'
    ]);
  }

  public function testHydrateGetReportWithDifferentData(): void
  {
    // Arrange
    $inputDto1 = new GetReportInputDto('report1', 'filters1');
    $inputDto2 = new GetReportInputDto('report2', 'filters2');
    $inputDto3 = new GetReportInputDto('report3', 'filters3');

    // Act
    $result1 = $this->hydrator->hydrateGetReport($inputDto1);
    $result2 = $this->hydrator->hydrateGetReport($inputDto2);
    $result3 = $this->hydrator->hydrateGetReport($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, [
      'ReportType' => 'report1',
      'ParamsFiltres' => 'filters1'
    ]);
    $this->assertHydratedObjectHasProperties($result2, [
      'ReportType' => 'report2',
      'ParamsFiltres' => 'filters2'
    ]);
    $this->assertHydratedObjectHasProperties($result3, [
      'ReportType' => 'report3',
      'ParamsFiltres' => 'filters3'
    ]);
  }

  public function testHydrateGetReportByTokenWithDifferentTokens(): void
  {
    // Arrange
    $inputDto1 = new GetReportByTokenInputDto('token1');
    $inputDto2 = new GetReportByTokenInputDto('token2');
    $inputDto3 = new GetReportByTokenInputDto('token3');

    // Act
    $result1 = $this->hydrator->hydrateGetReportByToken($inputDto1);
    $result2 = $this->hydrator->hydrateGetReportByToken($inputDto2);
    $result3 = $this->hydrator->hydrateGetReportByToken($inputDto3);

    // Assert
    $this->assertHydratedObjectHasProperties($result1, ['token' => 'token1']);
    $this->assertHydratedObjectHasProperties($result2, ['token' => 'token2']);
    $this->assertHydratedObjectHasProperties($result3, ['token' => 'token3']);
  }

  public function testAllMethodsReturnObjects(): void
  {
    // Arrange
    $depannageInput = new GetDetailsDepannageInpuDto('123');
    $excelInput = new GetExcelInpuDto('type', 'params');
    $reportInput = new GetReportInputDto('type', 'params');
    $tokenInput = new GetReportByTokenInputDto('token');

    // Act & Assert
    $this->assertIsObject($this->hydrator->hydrateGetDetailsDepannage($depannageInput));
    $this->assertIsObject($this->hydrator->hydrateGetExcel($excelInput));
    $this->assertIsObject($this->hydrator->hydrateGetReport($reportInput));
    $this->assertIsObject($this->hydrator->hydrateGetReportByToken($tokenInput));
  }

  public function testHydratedObjectsAreConsistent(): void
  {
    // Arrange
    $inputDto = new GetDetailsDepannageInpuDto('123');

    // Act
    $result1 = $this->hydrator->hydrateGetDetailsDepannage($inputDto);
    $result2 = $this->hydrator->hydrateGetDetailsDepannage($inputDto);

    // Assert
    $this->assertEquals($result1, $result2);
  }

  public function testHydratedObjectsHaveCorrectPropertyTypes(): void
  {
    // Arrange
    $depannageInput = new GetDetailsDepannageInpuDto('123');
    $excelInput = new GetExcelInpuDto('type', 'params');
    $reportInput = new GetReportInputDto('type', 'params');
    $tokenInput = new GetReportByTokenInputDto('token');

    // Act
    $depannageResult = $this->hydrator->hydrateGetDetailsDepannage($depannageInput);
    $excelResult = $this->hydrator->hydrateGetExcel($excelInput);
    $reportResult = $this->hydrator->hydrateGetReport($reportInput);
    $tokenResult = $this->hydrator->hydrateGetReportByToken($tokenInput);

    // Assert
    $this->assertHydratedObjectPropertyTypes($depannageResult, [
      'WorkOrderNumber' => 'string'
    ]);
    $this->assertHydratedObjectPropertyTypes($excelResult, [
      'ReportType' => 'string',
      'ParamsFiltres' => 'string'
    ]);
    $this->assertHydratedObjectPropertyTypes($reportResult, [
      'ReportType' => 'string',
      'ParamsFiltres' => 'string'
    ]);
    $this->assertHydratedObjectPropertyTypes($tokenResult, [
      'token' => 'string'
    ]);
  }

  public function testMethodsReturnStdClassObjects(): void
  {
    // Arrange
    $inputDto = new GetDetailsDepannageInpuDto('123');

    // Act
    $result = $this->hydrator->hydrateGetDetailsDepannage($inputDto);

    // Assert
    $this->assertInstanceOf(\stdClass::class, $result);
  }

  public function testGetExcelAndGetReportHaveSameStructure(): void
  {
    // Arrange
    $excelInput = new GetExcelInpuDto('type', 'params');
    $reportInput = new GetReportInputDto('type', 'params');

    // Act
    $excelResult = $this->hydrator->hydrateGetExcel($excelInput);
    $reportResult = $this->hydrator->hydrateGetReport($reportInput);

    // Assert
    $this->assertEquals($excelResult, $reportResult);
  }

  public function testConstructorParametersAreNotUsedInHydration(): void
  {
    // Arrange
    $inputDto = new GetDetailsDepannageInpuDto('123');

    // Act
    $result = $this->hydrator->hydrateGetDetailsDepannage($inputDto);

    // Assert
    $this->assertHydratedObjectDoesNotContainValues($result, [
      $this->superLoginID,
      $this->superPassword,
      $this->adminSessionId
    ]);
  }
}
