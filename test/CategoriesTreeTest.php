<?php
/**
 * Created by PhpStorm.
 * User: Juslintek
 * Date: 2017-05-11
 * Time: 13:21
 */

use Juslintek\NestedCategories\Composites\CategoriesTree;
use PHPUnit\Framework\TestCase;

class CategoriesTreeTest extends TestCase
{
    public function testIterateCategories()
    {
        $this->assertInstanceOf(
            CategoriesTree::class,
            new CategoriesTree()
        );
    }
}
