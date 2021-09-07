# Sample 06 - Adminhtml

## TODO
* **routes.xml**
    * Examine `adminhtml/routes.xml` config file. What is the difference compared to `frontend/routes.xml`?
* **menu.xml and Controllers**
    * Examine `adminhtml/menu.xml` config file.
    * Try to access "Hello World" page from a menu (_Content > Hello World_).
    * Examine `Inchoo\Sample06\Controller\Adminhtml\Index\Index` controller. What is the difference between frontend 
      and adminhtml controller?
    * Add "Postcode Management" submenu item under _System > Other Settings_. Link needs to open the Postcode grid page 
      (`sample06/postcode/grid`).
* **acl.xml**
    * Examine `acl.xml` config file. 
    * In the admin area find where `Inchoo_Sample06::hello_world` resource can be assigned to the user role.
    * Create custom `Inchoo_Sample06::postcode` ACL resource and edit all postcode controllers and menus to use 
      the newly created ACL resource.
* **UI Components (listing, form)**
    * Examine `view/adminhtml/ui_component/*` config files and how they are included in 
      `view/adminhtml/layout/*` handle files.
    * Examine PHP classes in `Ui` directory and how/where they are used.
    * Add `city` column/field to the Postcode grid and form.
    * Implement mass delete action on the Postcode grid (look for examples in Magento_Cms module).
    * Add custom "Canonical URL" text input field to CMS Page form (_Content > Pages > Edit_). Save implementation
      is not required.
* **System Configuration**
    * Examine `adminhtml/system.xml` config file.
    * In the admin area find where you can edit _sample06_ configs (_Stores > Settings > Configuration_).
    * In the admin area save different values per scope (default, website, store view) for _sample06_ configs.
    * Examine `core_config_data` DB table. Find _sample06_ configs and examine how they are saved.
    * Examine how are configs used in the `hello-world.phtml` template. Implement `content` config to the template.
    * Examine `config.xml` config file. Add default value for `content` config.
    * Create custom "Catalog Search Meta Robots" config:
        * Admin area location: _Stores > Settings > Configuration > Catalog > Catalog > Search Engine Optimization_.
        * Use `Inchoo\Sample06\Model\Source\RobotsMetaTag` class for select options source.
        * Needs to be available only in `default` and `website` scopes. Enable restore functionality.
        * Set "NOINDEX,FOLLOW" as default config value.
        * Display config value in the `hello-world.phtml` template.
