<?php

declare(strict_types=1);

namespace App\Tests\Integration\Http\Action\Security;

use App\Http\Action\Security\LoginAction;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Security\LoginUseCase;
use App\Application\Factory\Security\SecurityInputFactory;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginActionTest extends \App\Tests\Integration\Http\Action\BaseActionTest
{
  private ResponderInterface $responder;
  private LoginUseCase $useCase;
  private SecurityInputFactory $inputFactory;
  private LoginAction $action;

  protected function setUp(): void
  {
    $this->responder = $this->createResponderMock();
    $this->useCase = $this->createUseCaseMock(LoginUseCase::class);
    $this->inputFactory = $this->createFactoryMock(SecurityInputFactory::class);

    $this->action = new LoginAction(
      $this->responder,
      $this->useCase,
      $this->inputFactory
    );
  }

  public function testLoginWithValidCredentials(): void
  {
    // Arrange
    $requestData = [
      'email' => 'test@example.com',
      'password' => 'password123'
    ];
    $request = $this->createJsonRequest('POST', '/security/login', $requestData);

    $inputDto = new LoginInputDto('test@example.com', 'password123');
    $outputDto = new LoginOutputDto(
      'jwt_token_123',
      'test@example.com',
      'Test User',
      'test@example.com',
      'admin',
      '123 Main St',
      '12345',
      'City',
      '1234567890',
      'John',
      'admin',
      'Client Name',
      5,
      100,
      200,
      300,
      400,
      true,
      'test@example.com',
      true,
      true,
      true,
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createLoginFromRequest')
      ->with($request)
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

  public function testLoginWithInvalidCredentials(): void
  {
    // Arrange
    $requestData = [
      'email' => 'invalid@example.com',
      'password' => 'wrongpassword'
    ];
    $request = $this->createJsonRequest('POST', '/security/login', $requestData);

    $inputDto = new LoginInputDto('invalid@example.com', 'wrongpassword');
    $outputDto = new LoginOutputDto(
      '',
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      false,
      null,
      false,
      false,
      false,
      false
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_UNAUTHORIZED);

    $this->inputFactory
      ->shouldReceive('createLoginFromRequest')
      ->with($request)
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

  public function testLoginWithMissingCredentials(): void
  {
    // Arrange
    $requestData = [];
    $request = $this->createJsonRequest('POST', '/security/login', $requestData);

    $inputDto = new LoginInputDto('', '');
    $outputDto = new LoginOutputDto(
      '',
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      false,
      null,
      false,
      false,
      false,
      false
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_BAD_REQUEST);

    $this->inputFactory
      ->shouldReceive('createLoginFromRequest')
      ->with($request)
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

  public function testLoginWithDifferentUserTypes(): void
  {
    // Arrange
    $requestData = [
      'email' => 'admin@example.com',
      'password' => 'admin123'
    ];
    $request = $this->createJsonRequest('POST', '/security/login', $requestData);

    $inputDto = new LoginInputDto('admin@example.com', 'admin123');
    $outputDto = new LoginOutputDto(
      'jwt_token_admin',
      'admin@example.com',
      'Admin User',
      'admin@example.com',
      'admin',
      '456 Admin St',
      '54321',
      'Admin City',
      '0987654321',
      'Admin',
      'admin',
      'Admin Client',
      10,
      200,
      400,
      600,
      800,
      true,
      'admin@example.com',
      true,
      true,
      true,
      true
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createLoginFromRequest')
      ->with($request)
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

  public function testLoginWithMalformedJson(): void
  {
    // Arrange
    $request = Request::create(
      '/security/login',
      'POST',
      [],
      [],
      [],
      ['CONTENT_TYPE' => 'application/json'],
      'invalid json'
    );

    $inputDto = new LoginInputDto('', '');
    $outputDto = new LoginOutputDto(
      '',
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      false,
      null,
      false,
      false,
      false,
      false
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_BAD_REQUEST);

    $this->inputFactory
      ->shouldReceive('createLoginFromRequest')
      ->with($request)
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

  public function testLoginWithEmptyRequest(): void
  {
    // Arrange
    $request = $this->createRequest('POST', '/security/login');

    $inputDto = new LoginInputDto('', '');
    $outputDto = new LoginOutputDto(
      '',
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      false,
      null,
      false,
      false,
      false,
      false
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_BAD_REQUEST);

    $this->inputFactory
      ->shouldReceive('createLoginFromRequest')
      ->with($request)
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

  public function testLoginWithSpecialCharacters(): void
  {
    // Arrange
    $requestData = [
      'email' => 'test+tag@example.com',
      'password' => 'p@ssw0rd!@#'
    ];
    $request = $this->createJsonRequest('POST', '/security/login', $requestData);

    $inputDto = new LoginInputDto('test+tag@example.com', 'p@ssw0rd!@#');
    $outputDto = new LoginOutputDto(
      'jwt_token_special',
      'test+tag@example.com',
      'Special User',
      'test+tag@example.com',
      'user',
      '789 Special St',
      '67890',
      'Special City',
      '1122334455',
      'Special',
      'user',
      'Special Client',
      3,
      50,
      100,
      150,
      200,
      true,
      'test+tag@example.com',
      false,
      false,
      false,
      false
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createLoginFromRequest')
      ->with($request)
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

  public function testLoginWithLongCredentials(): void
  {
    // Arrange
    $longEmail = str_repeat('a', 100) . '@example.com';
    $longPassword = str_repeat('b', 100);

    $requestData = [
      'email' => $longEmail,
      'password' => $longPassword
    ];
    $request = $this->createJsonRequest('POST', '/security/login', $requestData);

    $inputDto = new LoginInputDto($longEmail, $longPassword);
    $outputDto = new LoginOutputDto(
      'jwt_token_long',
      $longEmail,
      'Long User',
      $longEmail,
      'user',
      '999 Long St',
      '99999',
      'Long City',
      '9999999999',
      'Long',
      'user',
      'Long Client',
      1,
      10,
      20,
      30,
      40,
      true,
      $longEmail,
      false,
      false,
      false,
      false
    );
    $expectedResponse = $this->createResponse($outputDto, Response::HTTP_OK);

    $this->inputFactory
      ->shouldReceive('createLoginFromRequest')
      ->with($request)
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
