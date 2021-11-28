<?php

namespace RandomUser\Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use RandomUser\Domain\User;

class UserTest extends TestCase
{
    /**
     * @dataProvider DTOProvider
     */
    public function testDTO(
        User $userObject,
        string $expectedName,
        string $expectedGender
    ): void {
        $this->assertSame($expectedName, $userObject->getName());
        $this->assertSame($expectedGender, $userObject->getGender());
    }

    public function DTOProvider(): array
    {
        return [
            [
                'resultObject' => new User('Edelina de Souza', 'female'),
                'expectedName' => 'Edelina de Souza',
                'expectedGender' => 'female'
            ],
            [
                'resultObject' => new User('	Giovanna Pawlik', 'male'),
                'expectedName' => '	Giovanna Pawlik',
                'expectedGender' => 'male'
            ]
        ];
    }
}