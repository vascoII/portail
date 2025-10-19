<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Dto\Input\Operator;

use App\Application\Dto\Input\Operator\CreateOperatorInputDto;
use App\Tests\Unit\Application\Dto\BaseDtoTest;

class CreateOperatorInputDtoTest extends BaseDtoTest
{
  public function testConstructorSetsAllProperties(): void
  {
    // Arrange
    $testData = $this->getTestData('operator');

    // Act
    $dto = new CreateOperatorInputDto(
      $testData['email'],
      $testData['lastname'],
      $testData['firstname'],
      $testData['phone'],
      $testData['job']
    );

    // Assert
    $this->assertDtoProperties($dto, $testData);
  }

  public function testDtoHasExpectedProperties(): void
  {
    // Arrange
    $dto = new CreateOperatorInputDto('', '', '', '', '');

    // Assert
    $this->assertDtoHasProperties($dto, [
      'email',
      'lastname',
      'firstname',
      'phone',
      'job'
    ]);
  }

  public function testDtoPropertiesAreReadonly(): void
  {
    // Arrange
    $dto = new CreateOperatorInputDto('', '', '', '', '');

    // Assert
    $this->assertDtoPropertiesAreReadonly($dto);
  }

  public function testDtoIsImmutable(): void
  {
    // Arrange
    $dto = new CreateOperatorInputDto('', '', '', '', '');

    // Assert
    $this->assertDtoIsImmutable($dto);
  }

  public function testConstructorRequiresAllParameters(): void
  {
    // Assert
    $this->assertDtoConstructorRequiresAllParameters(CreateOperatorInputDto::class, [
      'email',
      'lastname',
      'firstname',
      'phone',
      'job'
    ]);
  }

  public function testWithValidData(): void
  {
    // Arrange
    $email = 'john.doe@example.com';
    $lastname = 'Doe';
    $firstname = 'John';
    $phone = '1234567890';
    $job = 'Senior Developer';

    // Act
    $dto = new CreateOperatorInputDto($email, $lastname, $firstname, $phone, $job);

    // Assert
    $this->assertEquals($email, $dto->email);
    $this->assertEquals($lastname, $dto->lastname);
    $this->assertEquals($firstname, $dto->firstname);
    $this->assertEquals($phone, $dto->phone);
    $this->assertEquals($job, $dto->job);
  }

  public function testWithEmptyStrings(): void
  {
    // Arrange & Act
    $dto = new CreateOperatorInputDto('', '', '', '', '');

    // Assert
    $this->assertEquals('', $dto->email);
    $this->assertEquals('', $dto->lastname);
    $this->assertEquals('', $dto->firstname);
    $this->assertEquals('', $dto->phone);
    $this->assertEquals('', $dto->job);
  }

  public function testWithSpecialCharacters(): void
  {
    // Arrange
    $email = 'test+tag@example.com';
    $lastname = "O'Connor";
    $firstname = 'José';
    $phone = '+33 1 23 45 67 89';
    $job = 'Développeur Full-Stack';

    // Act
    $dto = new CreateOperatorInputDto($email, $lastname, $firstname, $phone, $job);

    // Assert
    $this->assertEquals($email, $dto->email);
    $this->assertEquals($lastname, $dto->lastname);
    $this->assertEquals($firstname, $dto->firstname);
    $this->assertEquals($phone, $dto->phone);
    $this->assertEquals($job, $dto->job);
  }

  public function testDtoIsFinalClass(): void
  {
    // Assert
    $reflection = new \ReflectionClass(CreateOperatorInputDto::class);
    $this->assertTrue($reflection->isFinal(), 'CreateOperatorInputDto should be final');
  }
}
