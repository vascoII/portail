<?php

declare(strict_types=1);

namespace App\Tests\Integration\Http\Action\Logement;

use App\Http\Action\Logement\GetLogementAction;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Logement\GetLogementUseCase;
use App\Application\Dto\Output\Logement\GetLogementOutputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetLogementActionTest extends \App\Tests\Integration\Http\Action\BaseActionTest
{
  private ResponderInterface $responder;
  private GetLogementUseCase $useCase;
  private GetLogementAction $action;

  protected function setUp(): void
  {
    $this->responder = $this->createResponderMock();
    $this->useCase = $this->createUseCaseMock(GetLogementUseCase::class);

    $this->action = new GetLogementAction(
      $this->responder,
      $this->useCase
    );
  }

  public function testGetLogementWithValidRequest(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/logements/1');

    $outputDto = new GetLogementOutputDto(
      1,
      'Apartment 1A',
      'A test apartment for demonstration',
      1,
      'A',
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

  public function testGetLogementWithUnauthorizedRequest(): void
  {
    // Arrange
    $request = $this->createRequest('GET', '/logements/1');

    $outputDto = new GetLogementOutputDto(null, null, null, null, null, false);
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

  public function testGetLogementWithInvalidToken(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/logements/1', 'invalid_token');

    $outputDto = new GetLogementOutputDto(null, null, null, null, null, false);
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

  public function testGetLogementWithQueryParameters(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/logements/1?include=details&format=full');

    $outputDto = new GetLogementOutputDto(
      1,
      'Apartment 1A',
      'A test apartment for demonstration with full details',
      1,
      'A',
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

  public function testGetLogementWithEmptyResult(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/logements/999');

    $outputDto = new GetLogementOutputDto(null, null, null, null, null, false);
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

  public function testGetLogementWithDifferentHttpMethods(): void
  {
    // Test POST method
    $request = $this->createAuthenticatedRequest('POST', '/logements/1');

    $outputDto = new GetLogementOutputDto(
      1,
      'Apartment 1A',
      'A test apartment for demonstration',
      1,
      'A',
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

  public function testGetLogementWithCustomHeaders(): void
  {
    // Arrange
    $request = Request::create(
      '/logements/1',
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

    $outputDto = new GetLogementOutputDto(
      1,
      'Apartment 1A',
      'A test apartment for demonstration',
      1,
      'A',
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

  public function testGetLogementWithRouteArgs(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/logements/1');
    $args = ['id' => 1];

    $outputDto = new GetLogementOutputDto(
      1,
      'Apartment 1A',
      'A test apartment for demonstration',
      1,
      'A',
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

  public function testGetLogementWithServerError(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/logements/1');

    $outputDto = new GetLogementOutputDto(null, null, null, null, null, false);
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

  public function testGetLogementWithLargeDataset(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/logements/999');

    $outputDto = new GetLogementOutputDto(
      999,
      'Large Apartment',
      'An apartment with extensive data and multiple properties for testing large dataset handling',
      10,
      'Z',
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
