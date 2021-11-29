<?php

namespace RandomUser\Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use RandomUser\Domain\User;

class UserTest extends TestCase
{
    private const DEFAULT_PASSWORD = 'abcd';

    /**
     * @dataProvider DTOProvider
     */
    public function testDTO(
        User $userObject,
        string $expectedName,
        string $expectedGender,
        string $expectedPassword
    ): void {
        $this->assertSame($expectedName, $userObject->getName());
        $this->assertSame($expectedGender, $userObject->getGender());
        $this->assertSame($expectedPassword, $userObject->getPassword());
    }

    public function DTOProvider(): array
    {
        return [
            [
                'resultObject' => new User('Edelina de Souza', 'female'),
                'expectedName' => 'Edelina de Souza',
                'expectedGender' => 'female',
                'expectedPassword' => self::DEFAULT_PASSWORD
            ],
            [
                'resultObject' => new User('	Giovanna Pawlik', 'male'),
                'expectedName' => '	Giovanna Pawlik',
                'expectedGender' => 'male',
                'expectedPassword' => self::DEFAULT_PASSWORD
            ]
        ];
    }
}