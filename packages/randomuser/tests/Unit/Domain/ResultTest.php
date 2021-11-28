<?php

namespace RandomUser\Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use RandomUser\Domain\Result;

class ResultTest extends TestCase
{
    /**
     * @dataProvider DTOProvider
     */
    public function testDTO(
        Result $resultObject,
        string $expectedResult
    ): void {
        $this->assertSame($expectedResult, $resultObject->getResult());
    }

    public function DTOProvider(): array
    {
        return [
            [
                'resultObject' => new Result(Result::RESULT_OK),
                'expectedResult' => 'OK'
            ],
            [
                'resultObject' => new Result(Result::RESULT_ERR),
                'expectedResult' => 'FAILED'
            ]
        ];
    }
}