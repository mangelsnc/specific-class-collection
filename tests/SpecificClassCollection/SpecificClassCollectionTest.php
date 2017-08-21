<?php

namespace Tests\SpecificClassCollection;

use PHPUnit\Framework\TestCase;

class SpecificClassCollectionTest extends TestCase
{
    /**
     * @test
     * @expectedException \SpecificClassCollection\InvalidClassException
     */
    public function itShouldThrowExceptionIfObjectAddedIsNotValid()
    {
        $testClass = new DateTimeCollection();
        $testClass->add(new \DateTimeZone('utc'));
    }

    /**
     * @test
     */
    public function itShouldAddOnlyValidClassObjects()
    {
        $testClass = new DateTimeCollection();

        $this->assertTrue($testClass->add(new \DateTime()));
    }

    /**
     * @test
     */
    public function itShouldReturnTheNumberOfElementsContainedInCollection()
    {
        $testClass = new DateTimeCollection();

        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());

        $this->assertEquals(5, $testClass->count());
    }

    /**
     * @test
     */
    public function itShouldClearAllTheCollection()
    {
        $testClass = new DateTimeCollection();

        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());

        $this->assertEquals(5, $testClass->count());

        $testClass->clear();

        $this->assertEquals(0, $testClass->count());
    }

    /**
     * @test
     */
    public function itShouldReturnAnArrayWithTheCollection()
    {
        $testClass = new DateTimeCollection();

        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());
        $testClass->add(new \DateTime());

        $this->assertTrue(is_array($testClass->getElements()));
    }
}