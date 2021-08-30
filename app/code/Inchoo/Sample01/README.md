# Sample 01 - Request Flow Processing

## TODO
* **URLs**
    * Make a request to these URL paths: `sample01/index/index`, `sample01/index`, `sample01`, `sample01/index/old`. 
      Examine and compare respective controllers.
* **routes.xml**
    * Change module's `frontName` to `hello` and try to make requests to existing controllers.
* **Controllers**
    * Create two new controllers that use `redirect` and `forward` result types. Examine what they do and how they differ.
    * Create a controller that responds to `hello/sub1_sub2/list` URL path.
* **HTTP request validation and data access**
    * Make a valid request to the `Inchoo\Sample01\Controller\Params\Get` controller. Examine how the controller accesses 
      data from a query string.
    * Make a valid request to the `Inchoo\Sample01\Controller\Params\Post` controller. Examine how the controller accesses 
      the data from the POST request.
* **URL rewrite**
    * Create a custom URL Rewrite from the admin area (Marketing / SEO & Search / URL Rewrites) that responds to 
      `inchoo` request path and uses the `Inchoo\Sample01\Controller\Params\Get` controller to display "_Inchoo_" 
      on the page.
