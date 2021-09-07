<?php

declare(strict_types=1);

namespace Inchoo\Sample07\Setup\Patch\Data;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateCustomIdProductAttribute implements DataPatchInterface
{
    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * CreateCustomIdProductAttribute constructor.
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

        $attributeCode = 'custom_id';
        $entityType = ProductAttributeInterface::ENTITY_TYPE_CODE;

        // create or update attribute
        $eavSetup->addAttribute($entityType, $attributeCode, [
            'type'         => 'int',
            'input'        => 'text',
            'label'        => 'Custom Id',
            'required'     => 0,
            'user_defined' => 1 // required for custom attributes
        ]);

        // add attribute to attribute sets (default group)
        foreach ($eavSetup->getAllAttributeSetIds($entityType) as $setId) {
            $defaultGroupId = $eavSetup->getDefaultAttributeGroupId($entityType, $setId);
            $eavSetup->addAttributeToSet($entityType, $setId, $defaultGroupId, $attributeCode);
        }

        return $this;
    }
}
