<?php

declare(strict_types=1);

namespace App\Tests\Integration\Http\Action\Immeuble;

use App\Http\Action\Immeuble\GetImmeubleAction;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Immeuble\GetImmeubleUseCase;
use App\Application\Factory\Shared\SharedInputFactory;
use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetImmeubleActionTest extends \App\Tests\Integration\Http\Action\BaseActionTest
{
  private ResponderInterface $responder;
  private GetImmeubleUseCase $useCase;
  private SharedInputFactory $inputFactory;
  private GetImmeubleAction $action;

  protected function setUp(): void
  {
    $this->responder = $this->createResponderMock();
    $this->useCase = $this->createUseCaseMock(GetImmeubleUseCase::class);
    $this->inputFactory = $this->createFactoryMock(SharedInputFactory::class);

    $this->action = new GetImmeubleAction(
      $this->responder,
      $this->useCase,
      $this->inputFactory
    );
  }

  public function testGetImmeubleWithValidRequest(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles/1');

    $outputDto = new GetImmeubleOutputDto(
      1,
      'Test Building',
      'A test building for demonstration',
      'REF123',
      '123 Main St',
      'Suite 100',
      'Building A',
      '12345',
      'City',
      true,
      1,
      true,
      new \DateTimeImmutable('2024-01-01'),
      new \DateTimeImmutable('2024-01-01'),
      true,
      true,
      true,
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('getIdIntFromRoute')
      ->once()
      ->with($request)
      ->andReturn(1);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
      ->with(1)
      ->andReturn($outputDto);

    $this->responder
      ->shouldReceive('respond')
      ->with($outputDto)
      ->once()
      ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request);

    // Assert
    $this->assertResponseSuccess($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
  }

  public function testGetImmeubleWithUnauthorizedRequest(): void
  {
    // Arrange
    $request = $this->createRequest('GET', '/immeubles/1');

    $outputDto = new GetImmeubleOutputDto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_UNAUTHORIZED);

    $this->inputFactory
      ->shouldReceive('getIdIntFromRoute')
      ->once()
      ->with($request)
      ->andReturn(1);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
      ->with(1)
      ->andReturn($outputDto);

    $this->responder
      ->shouldReceive('respond')
      ->with($outputDto)
      ->once()
      ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request);

    // Assert
    $this->assertResponseClientError($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
  }

  public function testGetImmeubleWithInvalidToken(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles/1', 'invalid_token');

    $outputDto = new GetImmeubleOutputDto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_UNAUTHORIZED);

    $this->inputFactory
      ->shouldReceive('getIdIntFromRoute')
      ->once()
      ->with($request)
      ->andReturn(1);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
      ->with(1)
      ->andReturn($outputDto);

    $this->responder
      ->shouldReceive('respond')
      ->with($outputDto)
      ->once()
      ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request);

    // Assert
    $this->assertResponseClientError($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
  }

  public function testGetImmeubleWithQueryParameters(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/immeubles/1?include=details&format=full');

    $outputDto = new GetImmeubleOutputDto(
      1,
      'Test Building',
      'A test building for demonstration with full details',
      'REF123',
      '123 Main St',
      'Suite 100',
      'Building A',
      '12345',
      'City',
      true,
      1,
      true,
      new \DateTimeImmutable('2024-01-01'),
      new \DateTimeImmutable('2024-01-01'),
      true,
      true,
      true,
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('getIdIntFromRoute')
      ->once()
      ->with($request)
      ->andReturn(1);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
      ->with(1)
      ->andReturn($outputDto);

    $this->responder
      ->shouldReceive('respond')
      ->with($outputDto)
      ->once()
      ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request);

    // Assert
    $this->assertResponseSuccess($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
  }

  public function testGetImmeubleWithEmptyResult(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles/999');

    $outputDto = new GetImmeubleOutputDto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_NOT_FOUND);

    $this->inputFactory
      ->shouldReceive('getIdIntFromRoute')
      ->once()
      ->with($request)
      ->andReturn(1);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
      ->with(1)
      ->andReturn($outputDto);

    $this->responder
      ->shouldReceive('respond')
      ->with($outputDto)
      ->once()
      ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request);

    // Assert
    $this->assertResponseClientError($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
  }

  public function testGetImmeubleWithDifferentHttpMethods(): void
  {
    // Test POST method
    $request = $this->createAuthenticatedRequest('POST', '/immeubles/1');

    $outputDto = new GetImmeubleOutputDto(
      1,
      'Test Building',
      'A test building for demonstration',
      'REF123',
      '123 Main St',
      'Suite 100',
      'Building A',
      '12345',
      'City',
      true,
      1,
      true,
      new \DateTimeImmutable('2024-01-01'),
      new \DateTimeImmutable('2024-01-01'),
      true,
      true,
      true,
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('getIdIntFromRoute')
      ->once()
      ->with($request)
      ->andReturn(1);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
      ->with(1)
      ->andReturn($outputDto);

    $this->responder
      ->shouldReceive('respond')
      ->with($outputDto)
      ->once()
      ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request);

    // Assert
    $this->assertResponseSuccess($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
  }

  public function testGetImmeubleWithCustomHeaders(): void
  {
    // Arrange
    $request = Request::create(
      '/immeubles/1',
      'GET',
      [],
      [],
      [],
      [
        'HTTP_AUTHORIZATION' => 'Bearer custom_token_123',
        'HTTP_X_CUSTOM_HEADER' => 'custom_value',
        'HTTP_ACCEPT' => 'application/json'
      ]
    );

    $outputDto = new GetImmeubleOutputDto(
      1,
      'Test Building',
      'A test building for demonstration',
      'REF123',
      '123 Main St',
      'Suite 100',
      'Building A',
      '12345',
      'City',
      true,
      1,
      true,
      new \DateTimeImmutable('2024-01-01'),
      new \DateTimeImmutable('2024-01-01'),
      true,
      true,
      true,
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('getIdIntFromRoute')
      ->once()
      ->with($request)
      ->andReturn(1);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
      ->with(1)
      ->andReturn($outputDto);

    $this->responder
      ->shouldReceive('respond')
      ->with($outputDto)
      ->once()
      ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request);

    // Assert
    $this->assertResponseSuccess($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
  }

  public function testGetImmeubleWithRouteArgs(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles/1');
    $args = ['id' => 1];

    $outputDto = new GetImmeubleOutputDto(
      1,
      'Test Building',
      'A test building for demonstration',
      'REF123',
      '123 Main St',
      'Suite 100',
      'Building A',
      '12345',
      'City',
      true,
      1,
      true,
      new \DateTimeImmutable('2024-01-01'),
      new \DateTimeImmutable('2024-01-01'),
      true,
      true,
      true,
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('getIdIntFromRoute')
      ->once()
      ->with($request)
      ->andReturn(1);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
      ->with(1)
      ->andReturn($outputDto);

    $this->responder
      ->shouldReceive('respond')
      ->with($outputDto)
      ->once()
      ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request, $args);

    // Assert
    $this->assertResponseSuccess($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
  }

  public function testGetImmeubleWithServerError(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles/1');

    $outputDto = new GetImmeubleOutputDto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_INTERNAL_SERVER_ERROR);

    $this->inputFactory
      ->shouldReceive('getIdIntFromRoute')
      ->once()
      ->with($request)
      ->andReturn(1);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
      ->with(1)
      ->andReturn($outputDto);

    $this->responder
      ->shouldReceive('respond')
      ->with($outputDto)
      ->once()
      ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request);

    // Assert
    $this->assertResponseServerError($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
  }

  public function testGetImmeubleWithLargeDataset(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles/999');

    $outputDto = new GetImmeubleOutputDto(
      999,
      'Large Building',
      'A building with extensive data and multiple properties for testing large dataset handling',
      'REF999',
      '999 Large Street',
      'Suite 999',
      'Building Z',
      '99999',
      'Large City',
      true,
      999,
      true,
      new \DateTimeImmutable('2024-01-01'),
      new \DateTimeImmutable('2024-01-01'),
      true,
      true,
      true,
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('getIdIntFromRoute')
      ->once()
      ->with($request)
      ->andReturn(1);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
      ->with(1)
      ->andReturn($outputDto);

    $this->responder
      ->shouldReceive('respond')
      ->with($outputDto)
      ->once()
      ->andReturn($expectedResponse);

    // Act
    $response = $this->action->__invoke($request);

    // Assert
    $this->assertResponseSuccess($response);
    $this->assertJsonResponse($response);
    $this->assertEquals($expectedResponse, $response);
  }
}
