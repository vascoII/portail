<?php

declare(strict_types=1);

namespace App\Tests\Integration\Http\Action\Immeuble;

use App\Http\Action\Immeuble\ListImmeublesAction;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Immeuble\ListImmeublesUseCase;
use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListImmeublesActionTest extends \App\Tests\Integration\Http\Action\BaseActionTest
{
  private ResponderInterface $responder;
  private ListImmeublesUseCase $useCase;
  private ListImmeublesAction $action;

  protected function setUp(): void
  {
    $this->responder = $this->createResponderMock();
    $this->useCase = $this->createUseCaseMock(ListImmeublesUseCase::class);

    $this->action = new ListImmeublesAction(
      $this->responder,
      $this->useCase
    );
  }

  public function testListImmeublesWithValidRequest(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles');

    $outputDto = new ListImmeublesOutputDto([
      (object)['id' => 1, 'name' => 'Building 1', 'address' => '123 Main St'],
      (object)['id' => 2, 'name' => 'Building 2', 'address' => '456 Oak Ave']
    ]);
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

  public function testListImmeublesWithUnauthorizedRequest(): void
  {
    // Arrange
    $request = $this->createRequest('GET', '/immeubles');

    $outputDto = new ListImmeublesOutputDto([]);
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

  public function testListImmeublesWithInvalidToken(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles', 'invalid_token');

    $outputDto = new ListImmeublesOutputDto([]);
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

  public function testListImmeublesWithQueryParameters(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/immeubles?city=Paris&type=residential&page=1');

    $outputDto = new ListImmeublesOutputDto([
      (object)['id' => 1, 'name' => 'Paris Building', 'address' => '123 Paris St', 'city' => 'Paris']
    ]);
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

  public function testListImmeublesWithEmptyResult(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles');

    $outputDto = new ListImmeublesOutputDto([]);
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

  public function testListImmeublesWithDifferentHttpMethods(): void
  {
    // Test POST method
    $request = $this->createAuthenticatedRequest('POST', '/immeubles');

    $outputDto = new ListImmeublesOutputDto([
      (object)['id' => 1, 'name' => 'Building 1', 'address' => '123 Main St']
    ]);
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

  public function testListImmeublesWithCustomHeaders(): void
  {
    // Arrange
    $request = Request::create(
      '/immeubles',
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

    $outputDto = new ListImmeublesOutputDto([
      (object)['id' => 1, 'name' => 'Building 1', 'address' => '123 Main St']
    ]);
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

  public function testListImmeublesWithRouteArgs(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles');
    $args = ['districtId' => 1];

    $outputDto = new ListImmeublesOutputDto([
      (object)['id' => 1, 'name' => 'District Building', 'address' => '123 District St']
    ]);
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

  public function testListImmeublesWithServerError(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles');

    $outputDto = new ListImmeublesOutputDto([]);
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

  public function testListImmeublesWithLargeDataset(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/immeubles');

    $immeubles = [];
    for ($i = 1; $i <= 100; $i++) {
      $immeubles[] = (object)[
        'id' => $i,
        'name' => "Building {$i}",
        'address' => "{$i} Street Name",
        'city' => $i % 2 === 0 ? 'Paris' : 'Lyon',
        'type' => $i % 3 === 0 ? 'residential' : 'commercial'
      ];
    }

    $outputDto = new ListImmeublesOutputDto($immeubles);
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
