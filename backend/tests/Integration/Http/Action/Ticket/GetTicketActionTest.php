<?php

declare(strict_types=1);

namespace App\Tests\Integration\Http\Action\Ticket;

use App\Http\Action\Ticket\GetTicketAction;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Ticket\GetTicketUseCase;
use App\Application\Dto\Output\Ticket\GetTicketOutputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetTicketActionTest extends \App\Tests\Integration\Http\Action\BaseActionTest
{
  private ResponderInterface $responder;
  private GetTicketUseCase $useCase;
  private GetTicketAction $action;

  protected function setUp(): void
  {
    $this->responder = $this->createResponderMock();
    $this->useCase = $this->createUseCaseMock(GetTicketUseCase::class);

    $this->action = new GetTicketAction(
      $this->responder,
      $this->useCase
    );
  }

  public function testGetTicketWithValidRequest(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/tickets/1');

    $outputDto = new GetTicketOutputDto(
      1,
      'Test Ticket',
      'A test ticket for demonstration',
      'open',
      'high',
      '2024-01-01',
      '2024-01-02',
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

  public function testGetTicketWithUnauthorizedRequest(): void
  {
    // Arrange
    $request = $this->createRequest('GET', '/tickets/1');

    $outputDto = new GetTicketOutputDto(null, null, null, null, null, null, null, false);
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

  public function testGetTicketWithInvalidToken(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/tickets/1', 'invalid_token');

    $outputDto = new GetTicketOutputDto(null, null, null, null, null, null, null, false);
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

  public function testGetTicketWithQueryParameters(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/tickets/1?include=details&format=full');

    $outputDto = new GetTicketOutputDto(
      1,
      'Test Ticket',
      'A test ticket for demonstration with full details',
      'open',
      'high',
      '2024-01-01',
      '2024-01-02',
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

  public function testGetTicketWithEmptyResult(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/tickets/999');

    $outputDto = new GetTicketOutputDto(null, null, null, null, null, null, null, false);
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

  public function testGetTicketWithDifferentHttpMethods(): void
  {
    // Test POST method
    $request = $this->createAuthenticatedRequest('POST', '/tickets/1');

    $outputDto = new GetTicketOutputDto(
      1,
      'Test Ticket',
      'A test ticket for demonstration',
      'open',
      'high',
      '2024-01-01',
      '2024-01-02',
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

  public function testGetTicketWithCustomHeaders(): void
  {
    // Arrange
    $request = Request::create(
      '/tickets/1',
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

    $outputDto = new GetTicketOutputDto(
      1,
      'Test Ticket',
      'A test ticket for demonstration',
      'open',
      'high',
      '2024-01-01',
      '2024-01-02',
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

  public function testGetTicketWithRouteArgs(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/tickets/1');
    $args = ['id' => 1];

    $outputDto = new GetTicketOutputDto(
      1,
      'Test Ticket',
      'A test ticket for demonstration',
      'open',
      'high',
      '2024-01-01',
      '2024-01-02',
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

  public function testGetTicketWithServerError(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/tickets/1');

    $outputDto = new GetTicketOutputDto(null, null, null, null, null, null, null, false);
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

  public function testGetTicketWithLargeDataset(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/tickets/999');

    $outputDto = new GetTicketOutputDto(
      999,
      'Large Ticket',
      'A ticket with extensive data and multiple properties for testing large dataset handling',
      'closed',
      'low',
      '2024-01-01',
      '2024-12-31',
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
