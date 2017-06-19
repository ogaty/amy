<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCaseWeb extends BaseTestCase
{
    use CreatesApplication;
    protected $baseUrl = 'http://dev-amy.ogatism.com';
}
