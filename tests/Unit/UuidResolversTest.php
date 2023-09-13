<?php

namespace Tests\Unit;

use Dyrynda\Database\Support\GeneratesUuid;
use Mockery;
use PHPUnit\Framework\TestCase;

class UuidResolversTest extends TestCase
{
    public static function provider_for_it_handles_uuid_versions(): array
    {
        return [
            ['uuid1', 'uuid1'],
            ['uuid4', 'uuid4'],
            ['uuid6', 'uuid6'],
            ['ordered', 'uuid6'],
            ['uuid999', 'uuid4'],
            ['uuid7', 'uuid7'],
        ];
    }

    /**
     * @test
     *
     * @param  string  $version
     * @param  string  $resolved
     *
     * @dataProvider provider_for_it_handles_uuid_versions
     */
    public function it_handles_uuid_versions($version, $resolved)
    {
        $generator = Mockery::mock(UuidTestClass::class)->makePartial();
        $generator->shouldReceive('uuidVersion')->once()->andReturn($version);

        $this->assertSame($resolved, $generator->resolveUuidVersion());
    }
}

class UuidTestClass
{
    use GeneratesUuid;
}
