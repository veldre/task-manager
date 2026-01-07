<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DbDriverTest extends TestCase
{
    public function test_tests_use_sqlite(): void
    {
        $this->assertSame('sqlite', DB::connection()->getDriverName());
    }
}
