<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Todo\ItemAlreadyExistsException;
use Todo\ItemText;
use Todo\ListIncomplete;
use Todo\ListManager;

class ListIncompleteTest extends TestCase
{
    public function setUp(): void
    {
        $this->listManager = new ListManager;
        $this->listIncomplete = $this->listManager->addList(new ListIncomplete);
    }

    public function testNewListIsEmpty()
    {
        $this->assertCount(0, $this->listIncomplete);
    }

    /**
     * @throws ItemAlreadyExistsException
     */
    public function testItAddsAnUntickedItem()
    {
        $this->listManager->addItem(new ItemText);
        $this->assertCount(1, $this->listIncomplete);
    }

    /**
     * @throws ItemAlreadyExistsException
     */
    public function testItDoesNotAddATickedItem()
    {
        $item = new ItemText;
        $item->tick(true);
        $this->listManager->addItem($item);
        $this->assertCount(0, $this->listIncomplete);
    }

    /**
     * @throws ItemAlreadyExistsException
     */
    public function testItRemovesATickedItem()
    {
        $item = new ItemText;
        $this->listManager->addItem($item);
        $this->assertCount(1, $this->listIncomplete);
        $item->tick(true);
        $this->assertCount(0, $this->listIncomplete);
    }
}
