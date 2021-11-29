<?php

namespace RandomUser\Tests\Unit\Domain\Model;

use MongoDB\Collection;
use RandomUser\Domain\User;
use RandomUser\Model\MongoUserModel;
use TestCase;

class MongoUserModelTest extends TestCase
{
    private const DEFAULT_PASSWORD = 'abcd';

    /**
     * @dataProvider saveProvider
     */
    public function testSave(
        User $user,
        array $expectedCall
    ): void {
        $collection = $this->createMock(Collection::class);
        $collection
            ->expects($this->once())
            ->method('insertOne')
            ->with($expectedCall);

        $model = new MongoUserModel($collection);

        $model->save($user);
    }

    public function saveProvider(): array
    {
        $now = date('Y-m-d H:i:s');

        return [
            [
                'user' => new User('Sedef Yetkiner', 'female'),
                'expectedCall' => [
                    'name' => 'Sedef Yetkiner',
                    'gender' => 'female',
                    'password' => self::DEFAULT_PASSWORD,
                    'created_at' => $now,
                    'updated_at' => $now
                ]
            ],
            [
                'user' => new User('Amisha Van Orsouw', 'male'),
                'expectedCall' => [
                    'name' => 'Amisha Van Orsouw',
                    'gender' => 'male',
                    'password' => self::DEFAULT_PASSWORD,
                    'created_at' => $now,
                    'updated_at' => $now
                ]
            ]
        ];
    }
}