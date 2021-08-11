# Sample 03 - Magento UI

## TODO
* **Layout**
    * Make a request to the `sample03/result/page` URL path and examine a respective controller.
    * Modify `routes.xml` so that the `inchoo_sample03_result_page` XML handle is auto added to the layout. Reload 
      `sample03/result/page` URL path to see what's changed. Examine `inchoo_sample03_result_page` handle and how 
      everything works and fits together.
    * Use `Inchoo\Sample03\Controller\Index\Weight` controller to display weight unit data from the 
      `Magento\Directory\Model\Config\Source\WeightUnit` class. Use best practices from the above task examples.
    * Use `default` XML layout to include `default/footer-additional.phtml` template to footer on every page 
      (hint: `footer` container).
    * Make a request to the `sample03/result/layout` URL path and examine a respective controller.
    * Template hints: `php bin/magento dev:template-hints:enable`
* **Theme**
    * Create and activate Inchoo/custom theme (use blank as parent).
    * Use `default` XML layout to include `default/content-additional.phtml` template to content on every page.
    * Override `hello-world.phtml` template in the theme and modify `h3` heading text.
    * From the theme use `inchoo_sample03_index_index` handle to render something of your choice in
      `inchoo_sample03_homepage_additional` container.
    * Examine layouts and templates in _Magento_Theme_ module (all main layouts are there).
