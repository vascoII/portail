<?php

declare(strict_types=1);

namespace App\Tests\Integration\Http\Action\Operator;

use App\Http\Action\Operator\ListOperatorsAction;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Operator\ListOperatorsUseCase;
use App\Application\Factory\Operator\OperatorInputFactory;
use App\Application\Dto\Input\Operator\ListOperatorsInputDto;
use App\Application\Dto\Output\Operator\ListOperatorsOutputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListOperatorsActionTest extends \App\Tests\Integration\Http\Action\BaseActionTest
{
  private ResponderInterface $responder;
  private ListOperatorsUseCase $useCase;
  private OperatorInputFactory $inputFactory;
  private ListOperatorsAction $action;

  protected function setUp(): void
  {
    $this->responder = $this->createResponderMock();
    $this->useCase = $this->createUseCaseMock(ListOperatorsUseCase::class);
    $this->inputFactory = $this->createFactoryMock(OperatorInputFactory::class);

    $this->action = new ListOperatorsAction(
      $this->responder,
      $this->useCase,
      $this->inputFactory
    );
  }

  public function testListOperatorsWithValidRequest(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/operators');

    $inputDto = new ListOperatorsInputDto('G');
    $outputDto = new ListOperatorsOutputDto([
      [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'type' => 'admin'
      ],
      [
        'id' => 2,
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
        'type' => 'user'
      ]
    ]);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createListOperatorsFromRequest')
      ->with($request, 'G')
      ->once()
      ->andReturn($inputDto);

    $this->useCase
      ->shouldReceive('execute')
      ->with($inputDto)
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

  public function testListOperatorsWithQueryParameters(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/operators?type=admin&status=active');

    $inputDto = new ListOperatorsInputDto('G');
    $outputDto = new ListOperatorsOutputDto([
      [
        'id' => 1,
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'type' => 'admin',
        'status' => 'active'
      ]
    ]);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createListOperatorsFromRequest')
      ->with($request, 'G')
      ->once()
      ->andReturn($inputDto);

    $this->useCase
      ->shouldReceive('execute')
      ->with($inputDto)
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

  public function testListOperatorsWithEmptyResult(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/operators');

    $inputDto = new ListOperatorsInputDto('G');
    $outputDto = new ListOperatorsOutputDto([]);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createListOperatorsFromRequest')
      ->with($request, 'G')
      ->once()
      ->andReturn($inputDto);

    $this->useCase
      ->shouldReceive('execute')
      ->with($inputDto)
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

  public function testListOperatorsWithUnauthorizedRequest(): void
  {
    // Arrange
    $request = $this->createRequest('GET', '/operators');

    $inputDto = new ListOperatorsInputDto('G');
    $outputDto = new ListOperatorsOutputDto([]);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_UNAUTHORIZED);

    $this->inputFactory
      ->shouldReceive('createListOperatorsFromRequest')
      ->with($request, 'G')
      ->once()
      ->andReturn($inputDto);

    $this->useCase
      ->shouldReceive('execute')
      ->with($inputDto)
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

  public function testListOperatorsWithInvalidToken(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('GET', '/operators', 'invalid_token');

    $inputDto = new ListOperatorsInputDto('G');
    $outputDto = new ListOperatorsOutputDto([]);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_UNAUTHORIZED);

    $this->inputFactory
      ->shouldReceive('createListOperatorsFromRequest')
      ->with($request, 'G')
      ->once()
      ->andReturn($inputDto);

    $this->useCase
      ->shouldReceive('execute')
      ->with($inputDto)
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

  public function testListOperatorsWithPagination(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/operators?page=2&limit=10');

    $inputDto = new ListOperatorsInputDto('G');
    $outputDto = new ListOperatorsOutputDto([
      [
        'id' => 11,
        'name' => 'Page 2 User 1',
        'email' => 'user11@example.com',
        'type' => 'user'
      ],
      [
        'id' => 12,
        'name' => 'Page 2 User 2',
        'email' => 'user12@example.com',
        'type' => 'user'
      ]
    ]);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createListOperatorsFromRequest')
      ->with($request, 'G')
      ->once()
      ->andReturn($inputDto);

    $this->useCase
      ->shouldReceive('execute')
      ->with($inputDto)
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

  public function testListOperatorsWithSearchQuery(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/operators?search=john');

    $inputDto = new ListOperatorsInputDto('G');
    $outputDto = new ListOperatorsOutputDto([
      [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'type' => 'admin'
      ]
    ]);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createListOperatorsFromRequest')
      ->with($request, 'G')
      ->once()
      ->andReturn($inputDto);

    $this->useCase
      ->shouldReceive('execute')
      ->with($inputDto)
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

  public function testListOperatorsWithSorting(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/operators?sort=name&order=desc');

    $inputDto = new ListOperatorsInputDto('G');
    $outputDto = new ListOperatorsOutputDto([
      [
        'id' => 2,
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
        'type' => 'user'
      ],
      [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'type' => 'admin'
      ]
    ]);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createListOperatorsFromRequest')
      ->with($request, 'G')
      ->once()
      ->andReturn($inputDto);

    $this->useCase
      ->shouldReceive('execute')
      ->with($inputDto)
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

  public function testListOperatorsWithCustomHeaders(): void
  {
    // Arrange
    $request = Request::create(
      '/operators',
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

    $inputDto = new ListOperatorsInputDto('G');
    $outputDto = new ListOperatorsOutputDto([]);
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createListOperatorsFromRequest')
      ->with($request, 'G')
      ->once()
      ->andReturn($inputDto);

    $this->useCase
      ->shouldReceive('execute')
      ->with($inputDto)
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
