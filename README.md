# Ajax Crud Module Nova 3
Example module using Ajax for listing, adding, editing, deleting and pagination for Nova 3

This module serves as an example of using Ajax with Nova. The index.php file loads the only view, containing an add and edit modal and div placeholder for the actualy content which is loaded via ajax and loaded into the div:

```php
<div id='crudBody' class='table-responsive'></div>
```

## Usage

Add the module in app/Config/Modules.php 

```php
'crud' => array(
    'namespace' => 'Crud',
    'enabled'   => true,
    'order'     => 1,
)
```

Then to access login to admin and access the module by going to /admin/crud.

examine the controllers and js/crud.js all files fully commented.