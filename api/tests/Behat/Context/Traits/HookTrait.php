<?php

namespace App\Tests\Behat\Context\Traits;

use DAMA\DoctrineTestBundle\Doctrine\DBAL\StaticDriver;

trait HookTrait
{
    /**
     * @BeforeSuite
     */
    public static function beforeSuite()
    {
        StaticDriver::setKeepStaticConnections(true);
    }

    /**
     * @BeforeScenario
     */
    public function beforeScenario()
    {
        /** Init default content-type */
        $this->requestHeaders["content-type"] = "application/ld+json";
        StaticDriver::beginTransaction();
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        $this->requestHeaders["content-type"] = "";
        StaticDriver::rollBack();
    }

    /**
     * @AfterSuite
     */
    public static function afterSuite()
    {
        StaticDriver::setKeepStaticConnections(false);
    }
}
