# Sample 02 - Object Manager & DI

## TODO
* **Object Manager**
    * Examine the `Inchoo\Sample02\Controller\ObjectManager\Example` controller and Object Manager usage.
* **di.xml**
    * Use `preference` to set default class for:
      `Inchoo\Sample02\Model\Preference\DummyInterface` => `Inchoo\Sample02\Model\Preference\DummyOne`. 
      Try to make the request to the `sample02/di/preference` URL path and examine `__construct()` method in a 
      respective controller.
    * Use `preference` to override a class:
      `Inchoo\Sample02\Model\Preference\DummyOne` => `Inchoo\Sample02\Model\Preference\DummyTwo`.
      Try to make the request to `sample02/di/preference` and `sample02/di/override` URL paths and examine 
      `__construct()` method in a respective controllers.
    * Find from where and how are `Inchoo\Sample02\Model\Sample::__construct()` arguments injected. 
      Try to modify them and check result on the `sample02/di/type` URL path. Use `frontend/di.xml` to change 
      `serialize` argument to `Magento\Framework\Serialize\Serializer\Serialize`.
    *  Use "_customVirtualSample_" `virtualType` in `di.xml` to modify `Inchoo\Sample02\Model\Sample::__construct()` 
       arguments. Check result on the `sample02/di/virtualtype` URL path.
* **Factory & Proxy**
    * Examine in the `Inchoo\Sample02\Controller\Index\Company` controller how is `companyFactory` property injected 
      and used. Find the auto generated `Factory` class and examine how it works.
    * Implement lazy-loading (proxy) in `Inchoo\Sample02\Controller\Index\LazyLoad` controller for `storeManager` 
      property. Find generated `Proxy` class and examine how it works.
