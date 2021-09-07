# Sample 04 - Working with Databases

## TODO
* **Declarative Schema**
    * Examine `etc/db_schema.xml` and `etc/db_schema_whitelist.json` files. Find and examine `inchoo_news` table 
      in the Database.
    * Create new `inchoo_news_comment` table with `entity_id`, `comment`, `news_id` columns. Create a foreign key 
      relationship `inchoo_news_comment.news_id` => `inchoo_news.entity_id`.
    * Update `etc/db_schema_whitelist.json` file. 
      `php bin/magento setup:db-declaration:generate-whitelist --module-name[=MODULE-NAME]`
* **Model / ResourceModel / Collection**
    * Examine `Inchoo\Sample04\Model\News`, `Inchoo\Sample04\Model\ResourceModel\News` and 
      `Inchoo\Sample04\Model\ResourceModel\News\Collection` classes.
    * Examine `sample04/news/...` controllers and how are model/resource/collection used for CRUD operations.
    * Create `sample04/news/delete` controller. It needs to delete news by an id.
    * On `sample04/news/list` page limit list to 5 news and display only enabled news (status=1). 
    * Create model/resource/collection for news comments (`inchoo_news_comment` table). Use them to display comments 
      under news with working links for CRUD operations.
* **Data and schema patches**
    * Examine `Inchoo\Sample04\Setup\Patch\Data\InitialNewsData` data patch.
    * Create data patch that creates random comments and assigns them to existing news.
    * Examine `patch_list` DB table.
* **Optional (ask mentor)**
    * Use setup scripts to create new `inchoo_news_author` table with `entity_id`, `name`, `created_at` columns.
