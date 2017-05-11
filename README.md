### REQUIREMENTS

 * php >=5.6
 * php_sqlite3
 * apache/nginx
 
### RUNNING PROJECT
 
 * composer install
 * Start apache or nginx with php-fpm
 * http://domain.tld/index.php
 
### WORKFLOW

 * During first run Database object creates sqlite database file
 * Use form to add new categories
 * On the left you will see recoursively formed tree on the right iteration formed array tree structure
 
### DESCRIPTION

Was trying to make use of composition design pattern. Which allow to compose objects into tree structures
to represent hierarchies. Example is DOM structure, which uses nested tree model, but it is very hard to created it.
So I picked more reasonable for time frame structure, which involves only specifying parent.
 
 