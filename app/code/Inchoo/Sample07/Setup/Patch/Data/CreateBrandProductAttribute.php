<?php

declare(strict_types=1);

namespace Inchoo\Sample07\Setup\Patch\Data;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateBrandProductAttribute implements DataPatchInterface
{
    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * CreateBrandProductAttribute constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return \Magento\Framework\Setup\Patch\PatchInterface
     */
    public function apply()
    {
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create();

        $attributeCode = 'brand';
        $entityType = ProductAttributeInterface::ENTITY_TYPE_CODE;

        // create or update attribute
        $eavSetup->addAttribute($entityType, $attributeCode, [
            'type'         => 'int',
            'input'        => 'select',
            'label'        => 'Brand',
            'required'     => 0,
            'user_defined' => 1, // required for custom attributes
            'searchable'   => 1, // use in Search
            'filterable'   => 1, // use in Layered Navigation
            'filterable_in_search' => 1, // use in Search results Layered Navigation,
            'visible_on_front'     => 1 // visible on product page
        ]);

        $attributeId = $eavSetup->getAttributeId($entityType, $attributeCode);

        // add attribute to attribute sets (default group)
        foreach ($eavSetup->getAllAttributeSetIds($entityType) as $setId) {
            $defaultGroupId = $eavSetup->getDefaultAttributeGroupId($entityType, $setId);
            $eavSetup->addAttributeToSet($entityType, $setId, $defaultGroupId, $attributeId);
        }

        // create attribute options (only for select or multiselect frontend inputs)
        $optionValues = ['Nike', 'Adidas', 'Puma', 'Reebok', 'Under Armor', 'Converse'];
        $eavSetup->addAttributeOption(['attribute_id' => $attributeId, 'values' => $optionValues]);

        return $this;
    }
}
