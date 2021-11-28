<?php

use Illuminate\Database\Query\Builder;
use RandomUser\Domain\User;
use RandomUser\Model\MysqlUserModel;

class MysqlUserModelTest extends TestCase
{
    private const DEFAULT_PASSWORD = 'abcd';

    /**
     * @dataProvider saveProvider
     */
    public function testSave(
        User $user,
        array $expectedCall
    ): void {
        $queryBuilder = $this->createMock(Builder::class);
        $queryBuilder
            ->expects($this->once())
            ->method('insert')
            ->with($expectedCall);

        $model = new MysqlUserModel($queryBuilder);

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