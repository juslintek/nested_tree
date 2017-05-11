<?php
/**
 * Created by PhpStorm.
 * User: Juslintek
 * Date: 2017-05-11
 * Time: 12:44
 */

namespace Juslintek\NestedCategories\Composites;

use Juslintek\NestedCategories\Database;

class CategoriesTree
{
    public $html = '';

    public $html2 = '';

    public function __construct()
    {
        $this->nestedCategories();
    }


    /**
     * Prints html structure using recoursive model.
     * @param array $results
     * @param int $parent
     */
    private function recourseCategories($results, $parent = 0)
    {
        $childCategories = array_filter($results, function ($row) use ($parent) {
            return $row['parent'] === $parent;
        });

        if (count(array_search($parent, $results)) > 0) {
            $this->html .= '<ul>';
            foreach ($childCategories as $row) {
                $this->html .= '<li><input type="radio" name="parent" value="' . $row['id'] . '">' . $row['title'];
                $this->recourseCategories($results, $row['id']);
                $this->html .= '</li>';
            }
            $this->html .= '</ul>';
        }
    }

    /**
     * Forms recursive structure via iterative method, which can be printed in html list only with recursive method.
     * @param array $results
     */
    private function iterateCategories($results)
    {
        $nested = [];

        foreach ($results as $key => $row) {


            if (!array_key_exists($row['id'], $nested)) {
                $nested[$row['id']] = array('children' => $row['title']);
            }
            else {
                $nested[$row['id']]['children'] = $row['title'];
            }

            // init parent
            if (!array_key_exists($row['parent'], $nested)) {
                $nested[$row['parent']] = array();
            }

            // add to parent
            $nested[$row['parent']][$row['id']] = & $nested[$row['id']];

        }


        $this->html2 = "<pre>".print_r($nested[0], true)."</pre>";
    }

    /**
     * @return void
     */
    private function nestedCategories()
    {
        // retrieve the left and right value of the $root node
        $result = Database::db()->query("SELECT * FROM tree");
        if ($result) {
            $categories = [];
            while ($results = $result->fetchArray(SQLITE3_ASSOC)) {
                $categories[] = $results;
            }

            $this->recourseCategories($categories);

            $this->iterateCategories($categories);
        }
    }
}