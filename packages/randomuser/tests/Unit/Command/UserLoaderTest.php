<?php

namespace RandomUser\Tests\Unit\Command;

use RandomUser\Contract\UserLoaderInterface;
use RandomUser\Contract\UserModelInterface;
use RandomUser\Domain\Result;
use RandomUser\Domain\User;
use RandomUser\Exception\LoadErrorException;
use RandomUser\Command\UserLoader;
use TestCase;

class UserLoaderTest extends TestCase
{
    /**
     * @dataProvider execProvider
     *
     * @param User[] $loaderReturn
     * @param array $expectedCall
     * @param Result $expectedResult
     */
    public function testExec(
        array $loaderReturn,
        array $expectedCall,
        Result $expectedResult
    ): void {
        $loader = $this->createMock(UserLoaderInterface::class);
        $userModel = $this->createMock(UserModelInterface::class);
        $model = new UserLoader(
            $loader,
            $userModel
        );

        $loader
            ->expects($this->once())
            ->method('load')
            ->willReturn($loaderReturn);

        $userModel
            ->expects($this->exactly(count($loaderReturn)))
            ->method('save')
            ->with(
                $this->callback(
                    function (User $userCall) use ($expectedCall) {
                        if(empty($expectedCall[$userCall->getName()])){
                            return false;
                        }
                        $user = $expectedCall[$userCall->getName()];
                        return $userCall->getGender() === $user;
                    }
                )
            );

        $this->assertEquals($expectedResult, $model->exec());
    }

    public function execProvider(): array
    {
        return [
            'one user' => [
                'loaderReturn' =>
                    [
                        new User('brad gibson', 'male'),
                    ],
                'expectedCall' =>
                    [
                        'brad gibson' => 'male'
                    ],
                'expectedResult' => new Result('OK')
            ],
            'two users' => [
                'loaderReturn' =>
                    [
                        new User('thomas gibson', 'male'),
                        new User('john smith', 'female')
                    ],
                'expectedCall' =>
                    [
                        'thomas gibson' => 'male',
                        'john smith' => 'female'
                    ],
                'expectedResult' => new Result('OK')
            ],
            'no user' => [
                'loaderReturn' => [],
                'expectedCall' => [],
                'expectedResult' => new Result('OK')
            ]
        ];
    }

    public function testLoadException()
    {
        $loader = $this->createMock(UserLoaderInterface::class);
        $userModel = $this->createMock(UserModelInterface::class);
        $model = new UserLoader(
            $loader,
            $userModel
        );

        $loader
            ->method('load')
            ->willThrowException(new LoadErrorException());

        $this->assertEquals(new Result('FAILED'), $model->exec());
    }
}
