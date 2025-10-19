<?php

declare(strict_types=1);

namespace App\Tests\Integration\Http\Action\Occupant;

use App\Http\Action\Occupant\GetOccupantAction;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Occupant\GetOccupantUseCase;
use App\Application\Factory\Shared\SharedInputFactory;
use App\Application\Dto\Output\Occupant\GetOccupantOutputDto;
use App\Domain\Entity\Occupant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Mockery;

class GetOccupantActionTest extends \App\Tests\Integration\Http\Action\BaseActionTest
{
  private ResponderInterface $responder;
  private GetOccupantUseCase $useCase;
  private SharedInputFactory $inputFactory;
  private GetOccupantAction $action;

  protected function setUp(): void
  {
    $this->responder = $this->createResponderMock();
    $this->useCase = $this->createUseCaseMock(GetOccupantUseCase::class);
    $this->inputFactory = $this->createFactoryMock(SharedInputFactory::class);

    $this->action = new GetOccupantAction(
      $this->responder,
      $this->useCase,
      $this->inputFactory
    );
  }

  public function testGetOccupantWithValidRequest(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/occupants/1');

    $occupant = Mockery::mock(Occupant::class);
    $outputDto = new GetOccupantOutputDto($occupant);
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

  public function testGetOccupantWithUnauthorizedRequest(): void
  {
    // Arrange
    $request = $this->createRequest('GET', '/occupants/1');

    $occupant = Mockery::mock(Occupant::class);
    $outputDto = new GetOccupantOutputDto($occupant);
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

  public function testGetOccupantWithInvalidToken(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/occupants/1', 'invalid_token');

    $outputDto = new GetOccupantOutputDto(null, null, null, null, null, null, null, false);
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

  public function testGetOccupantWithQueryParameters(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/occupants/1?include=details&format=full');

    $outputDto = new GetOccupantOutputDto(
      1,
      'John Doe',
      'john@example.com',
      '1234567890',
      '123 Main St',
      '12345',
      'City',
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

  public function testGetOccupantWithEmptyResult(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/occupants/999');

    $outputDto = new GetOccupantOutputDto(null, null, null, null, null, null, null, false);
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

  public function testGetOccupantWithDifferentHttpMethods(): void
  {
    // Test POST method
    $request = $this->createAuthenticatedRequest('POST', '/occupants/1');

    $outputDto = new GetOccupantOutputDto(
      1,
      'John Doe',
      'john@example.com',
      '1234567890',
      '123 Main St',
      '12345',
      'City',
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

  public function testGetOccupantWithCustomHeaders(): void
  {
    // Arrange
    $request = Request::create(
      '/occupants/1',
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

    $outputDto = new GetOccupantOutputDto(
      1,
      'John Doe',
      'john@example.com',
      '1234567890',
      '123 Main St',
      '12345',
      'City',
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

  public function testGetOccupantWithRouteArgs(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/occupants/1');
    $args = ['id' => 1];

    $outputDto = new GetOccupantOutputDto(
      1,
      'John Doe',
      'john@example.com',
      '1234567890',
      '123 Main St',
      '12345',
      'City',
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

  public function testGetOccupantWithServerError(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/occupants/1');

    $outputDto = new GetOccupantOutputDto(null, null, null, null, null, null, null, false);
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

  public function testGetOccupantWithLargeDataset(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/occupants/999');

    $outputDto = new GetOccupantOutputDto(
      999,
      'Large Occupant',
      'occupant@example.com',
      '9999999999',
      '999 Large Street',
      '99999',
      'Large City',
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
