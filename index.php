<?php
/**
 * Created by PhpStorm.
 * User: Juslintek
 * Date: 2017-05-11
 * Time: 12:27
 */

define('WEBROOT', __DIR__);

if (!class_exists('SQLite3')) {
    exit("SQLite 3 is missing, please turn it on.");
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';


function addCategory($title, $parent)
{
    $category = new Juslintek\NestedCategories\Composites\Category();
    $category->addCategory($title, $parent);
}

function getCategories()
{
    return new Juslintek\NestedCategories\Composites\CategoriesTree();
}

if (isset($_POST['title'])) {
    addCategory($_POST['title'], isset($_POST['parent']) ? $_POST['parent'] : 1);
}

?>
<html>
<head>

</head>
<body>
<form method="post" action="">
    <fieldset>
        <legend>Category paramters</legend>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="">
        <button type="submit">Add Category</button>
    </fieldset>

    <div style="display: block; float: left; width: 50%">
        <fieldset>
            <legend>Parent Category</legend>
            <ul>
                <?php
                echo getCategories()->html;
                ?>
            </ul>
        </fieldset>
    </div>
    <div style="display: block; float: left; width: 50%">
        <fieldset>
            <legend>Parent Category</legend>
            <ul>
                <?php
                echo getCategories()->html2;
                ?>
            </ul>
        </fieldset>
    </div>
</form>
</body>

</html>