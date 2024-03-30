<?php

namespace App\Services;

use App\Repositories\TestRepository;

class TestService
{
    protected $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function testDatabaseConnection()
    {
        return $this->testRepository->testDatabaseConnection();
    }
}
