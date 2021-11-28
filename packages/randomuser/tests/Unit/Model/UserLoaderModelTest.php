<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Psr\Http\Message\ResponseInterface;
use RandomUser\Domain\User;
use RandomUser\Exception\LoadErrorException;
use RandomUser\Model\UserLoaderModel;

class UserLoaderModelTest extends TestCase
{
    /**
     * @dataProvider loadProvider
     *
     * @param string $getBodyReturn
     * @param string $url
     * @param User[] $expectedResult
     *
     * @throws LoadErrorException
     */
    public function testLoad(
        string $getBodyReturn,
        string $url,
        array $expectedResult
    ): void {
          $loader= $this->createMock(Client::class);
          $response = $this->createMock(ResponseInterface::class);

          $loader
              ->expects($this->once())
              ->method('get')
              ->with($url)
              ->willReturn($response);
          $response
              ->expects($this->once())
              ->method('getBody')
              ->willReturn($getBodyReturn);

          $model = new UserLoaderModel($loader);

          $this->assertEquals($expectedResult, $model->load());
    }

    public function loadProvider(): array
    {
        return [
            'two user' => [
                'getBodyReturn' => '
                    {
                          "results": [
                            {
                              "gender": "male",
                              "name": {
                                "first": "brad",
                                "last": "gibson"
                              }
                            },
                            {
                              "gender": "female",
                              "name": {
                                "first": "john",
                                "last": "smith"
                              }
                            }
                          ]
                    }',
                'url' => env('RANDOMUSER_URL'),
                'expectedResult' => [
                    new User('brad gibson' , 'male'),
                    new User('john smith' , 'female')
                ]
            ],
            'empty result' => [
                'getBodyReturn' => '
                    {
                          "results": [
                          ]
                    }',
                'url' => env('RANDOMUSER_URL'),
                'expectedResult' => []
            ],
        ];
    }

    public function testLoadException()
    {
        $loader= $this->createMock(Client::class);
        $model = new UserLoaderModel($loader);

        $loader
            ->method('get')
            ->willThrowException(new TransferException());

        $this->expectException(LoadErrorException::class);

        $model->load();
    }
}