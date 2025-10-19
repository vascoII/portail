<?php

declare(strict_types=1);

namespace App\Tests\Integration\Http\Action\Security;

use App\Http\Action\Security\LogoutAction;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Security\LogoutUseCase;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LogoutActionTest extends \App\Tests\Integration\Http\Action\BaseActionTest
{
  private ResponderInterface $responder;
  private LogoutUseCase $useCase;
  private LogoutAction $action;

  protected function setUp(): void
  {
    $this->responder = $this->createResponderMock();
    $this->useCase = $this->createUseCaseMock(LogoutUseCase::class);

    $this->action = new LogoutAction(
      $this->responder,
      $this->useCase
    );
  }

  public function testLogoutWithValidSession(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('POST', '/security/logout');

    $outputDto = new LogoutOutputDto(true);
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

  public function testLogoutWithInvalidSession(): void
  {
    // Arrange
    $request = $this->createRequest('POST', '/security/logout');

    $outputDto = new LogoutOutputDto(false);
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

  public function testLogoutWithExpiredToken(): void
  {
    // Arrange
    $request = $this->createAuthenticatedRequest('POST', '/security/logout', 'expired_token');

    $outputDto = new LogoutOutputDto(false);
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

  public function testLogoutWithMalformedToken(): void
  {
    // Arrange
    $request = Request::create(
      '/security/logout',
      'POST',
      [],
      [],
      [],
      ['HTTP_AUTHORIZATION' => 'Invalid token format']
    );

    $outputDto = new LogoutOutputDto(false);
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

  public function testLogoutWithEmptyToken(): void
  {
    // Arrange
    $request = Request::create(
      '/security/logout',
      'POST',
      [],
      [],
      [],
      ['HTTP_AUTHORIZATION' => 'Bearer ']
    );

    $outputDto = new LogoutOutputDto(false);
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

  public function testLogoutWithNoAuthorizationHeader(): void
  {
    // Arrange
    $request = $this->createRequest('POST', '/security/logout');

    $outputDto = new LogoutOutputDto(false);
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

  public function testLogoutWithDifferentHttpMethods(): void
  {
    // Test GET method
    $request = $this->createAuthenticatedRequest('GET', '/security/logout');

    $outputDto = new LogoutOutputDto(true);
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

  public function testLogoutWithQueryParameters(): void
  {
    // Arrange
    $request = $this->createQueryRequest('/security/logout?force=true');

    $outputDto = new LogoutOutputDto(true);
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

  public function testLogoutWithCustomHeaders(): void
  {
    // Arrange
    $request = Request::create(
      '/security/logout',
      'POST',
      [],
      [],
      [],
      [
        'HTTP_AUTHORIZATION' => 'Bearer custom_token_123',
        'HTTP_X_CUSTOM_HEADER' => 'custom_value',
        'CONTENT_TYPE' => 'application/json'
      ]
    );

    $outputDto = new LogoutOutputDto(true);
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
