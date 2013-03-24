openlss/lib-url
=======

URL building library that allows dynamic registration at runtime.

Usage
----
```php
ld('url');

//registration
Url::_register('home',Url::_prep().'/index.php');
Url::_register('myapp',Url::home().'?act=myapp');
Url::_register('myapp_create',Url::myapp().'&do=create');
Url::_register('myapp_edit',Url::myapp().'&do=edit&id=$1');

//usage
$url = Url::home();
$url = Url::myapp();
$url = Url::myapp_create();
$url = Url::myapp_edit($id);
```

Reference
----

### (string) Url::_prep()
Returns the configured root URL

### (bool) Url::_isCallable($func)
Check if a URL function has been registered

### (array) Url::_all()
Returns all URLs that dont need arguments (global URLs)

### (void) Url::_register($name,$url)
  * $name		The function name to access the URL
  * $url		The URL itself, use of other functions is encouraged
   * $1 $2 $3	Numbered arguments similar to regex back-referencing
                they reference the parameter number passed to the URL
                function

