<?php

namespace App\Tests\Behat\Context\Traits;

trait ReferenceTrait
{
    /**
     *
     * @var array[]
     */
    protected $references = array();

    /**
     * @Then /^I save the response in the reference "([^"]*)"$/
     */
    public function iSaveInReference($name)
    {
        $this->references[$name] = $this->getLastResponse();
    }

    /**
     * @Then /^I use reference "([^"]*)" as last response/
     */
    public function iUseThisReferenceAsRequest($ref)
    {
        $this->lastResponse = $this->references[$ref];
    }

    /**
     * @Then /^I dump actual references/
     */
    public function iDumpReferences()
    {
       dump($this->references);
    }
}
