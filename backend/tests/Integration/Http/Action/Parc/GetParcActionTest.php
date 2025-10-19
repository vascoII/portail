<?php

declare(strict_types=1);

namespace App\Tests\Integration\Http\Action\Parc;

use App\Http\Action\Parc\GetParcAction;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Parc\GetParcUseCase;
use App\Application\Dto\Output\Parc\GetParcOutputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetParcActionTest extends \App\Tests\Integration\Http\Action\BaseActionTest
{
  private ResponderInterface $responder;
  private GetParcUseCase $useCase;
  private GetParcAction $action;

  protected function setUp(): void
  {
    $this->responder = $this->createResponderMock();
    $this->useCase = $this->createUseCaseMock(GetParcUseCase::class);

    $this->action = new GetParcAction(
      $this->responder,
      $this->useCase
    );
  }

  public function testGetParcWithValidRequest(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/parc');

    $outputDto = new GetParcOutputDto(
      1,
      'Test Parc',
      'A test parc for demonstration',
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
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

  public function testGetParcWithUnauthorizedRequest(): void
  {
    // Arrange
    $request = $this->createRequest('GET', '/parc');

    $outputDto = new GetParcOutputDto(null, null, null, false);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_UNAUTHORIZED);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
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

  public function testGetParcWithInvalidToken(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/parc', 'invalid_token');

    $outputDto = new GetParcOutputDto(null, null, null, false);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_UNAUTHORIZED);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
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

  public function testGetParcWithQueryParameters(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/parc?include=details&format=full');

    $outputDto = new GetParcOutputDto(
      1,
      'Test Parc',
      'A test parc for demonstration with full details',
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
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

  public function testGetParcWithEmptyResult(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/parc');

    $outputDto = new GetParcOutputDto(null, null, null, false);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_NOT_FOUND);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
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

  public function testGetParcWithDifferentHttpMethods(): void
  {
    // Test POST method
    $request = $this->createAuthenticatedRequest('POST', '/parc');

    $outputDto = new GetParcOutputDto(
      1,
      'Test Parc',
      'A test parc for demonstration',
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
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

  public function testGetParcWithCustomHeaders(): void
  {
    // Arrange
    $request = Request::create(
      '/parc',
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

    $outputDto = new GetParcOutputDto(
      1,
      'Test Parc',
      'A test parc for demonstration',
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
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

  public function testGetParcWithRouteArgs(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/parc');
    $args = ['id' => 1];

    $outputDto = new GetParcOutputDto(
      1,
      'Test Parc',
      'A test parc for demonstration',
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
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

  public function testGetParcWithServerError(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/parc');

    $outputDto = new GetParcOutputDto(null, null, null, false);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_INTERNAL_SERVER_ERROR);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
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

  public function testGetParcWithLargeDataset(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/parc');

    $outputDto = new GetParcOutputDto(
      999,
      'Large Parc',
      'A parc with extensive data and multiple properties for testing large dataset handling',
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->useCase
      ->shouldReceive('execute')
      ->once()
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
