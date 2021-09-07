# Sample 05 - Service Contracts

## TODO
* **API Interfaces**
    * Examine PHP interfaces in a module's `Api` directory. Examine classes that implement those interfaces.
    * Create `Inchoo\Sample05\Api\Data\EventInterface` => `Inchoo\Sample05\Model\Event` preference.
    * Finish `Inchoo\Sample05\Model\EventRepository::save()` method implementation.
    * Find where and how `Inchoo\Sample05\Api\EventRepositoryInterface` is used. 
    * On `sample05/event/list` page limit list to 5 events and display only enabled events (status=1).
    * Find and view what API interfaces are in Magento_Customer and Magento_Catalog modules.
* **Web API**
    * Examine `etc/webapi.xml` config file.
    * Try to make request to `rest/V1/events/5` and `rest/V1/events` endpoints. What is the difference?
    * Create an endpoint with which we can delete an event by an id.
* **Optional (ask mentor)**
    * Refactor `Inchoo_Sample04` module to use repository logic.
