# Sample 07 - EAV

## TODO
* **Catalog Attributes**
    * Examine how is product attribute created in `CreateCustomIdProductAttribute` data patch.
        * Find and examine `custom_id` product attribute in `eav_attribute` DB table.
        * Save `custom_id` attribute value to some product (product edit form) and find where the value is saved 
          in one of `catalog_product_entity*` DB tables.
    * Create a new "Page H1 Title" product attribute:
        * Backend type needs to be `varchar` and frontend input needs to be `text`.
        * Needs to be assigned to `Search Engine Optimization` attribute groups.
        * Save "Page H1 Title" attribute value to some product (product edit form) and find where the value is saved 
          in one of `catalog_product_entity*` DB tables.
    * Examine how is category attribute created in `CreateCustomDescriptionCategoryAttribute` data patch.
        * Add `custom_description` attribute to category edit form (`ui_component/category_form.xml`).
        * Save `custom_description` attribute value to some category (category edit form) and find where the value 
          is saved in one of `catalog_category_entity*` DB tables.
* **Customer Attributes**
    * Examine how is customer attribute created in `CreateOibCustomerAttribute` data patch.
        * Use `Magento\Eav\Setup\EavSetup::updateAttribute()` to add `oib` attribute column 
          to customer grid and make it filterable (`is_used_in_grid`, `is_filterable_in_grid`).
        * Find in which DB table are `is_used_in_grid` and `is_filterable_in_grid` values saved 
          (`eav_entity_type.additional_attribute_table`).
        * Check if customer grid in admin area displays "OIB" column and values (`customer_grid` indexer 
          and `eav` cache).
    * Examine how is customer address attribute created in `CreateMobileNumberAddressAttribute` data patch.
        * Assign `mobile_number` attribute to customer address forms (`adminhtml_customer_address`, 
          `customer_address_edit`, `customer_register_address`). Check how it's done for customer attribute in 
          `CreateOibCustomerAttribute` data patch.
* **Attribute Options**
    * Examine how are attributes with options created in `CreateBrandProductAttribute` and 
      `CreateWebExclusiveProductAttribute` data patches.
        * Examine how are `brand` attribute options saved in `eav_attribute_option` and `eav_attribute_option_value` 
          DB tables. From where `web_exclusive` attribute options come from?
    * Create a new `season` product attribute:
        * Backend type needs to be `varchar` and frontend input needs to be `multiselect`.
        * Use `Inchoo\Sample07\Model\Source\Attribute\Season` as source model.
        * Use `Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend` as backend model.
        * Needs to be assigned to default attribute groups.
    * Use product edit form to edit and save select/multiselect attribute values. Examine how are values saved in
      `catalog_product_entity*` DB tables and how it's connected with `eav_attribute_option` DB table.
* **Display Attribute Values**
    * Examine how is a product EAV data loaded and used in `Inchoo\Sample07\ViewModel\ProductList` view model 
      and `catalog/product-list.phtml` template.
        * Add `description` and `brand` product attribute data to collection and display it in the template.
        * Display only enabled products (`status`) in the template.
    * Use `Inchoo\Sample07\ViewModel\CategoryList` view model and `catalog/category-list.phtml` template to:
        * Display `name` and `custom_description` for every loaded category.
        * Display only enabled categories with `neq` condition (`is_active`).
        * Filter collection by `level` attribute (level=2).
        * Sort collection items by `position` attribute.
        * Create a category page URLs and display them in the template.
* **Optional (ask mentor)**
    * Make `season` attribute available in Layered Navigation.
    * Add `oib` and `mobile_number` attributes to frontend customer account forms.
    * Add `mobile_number` to checkout address forms.
