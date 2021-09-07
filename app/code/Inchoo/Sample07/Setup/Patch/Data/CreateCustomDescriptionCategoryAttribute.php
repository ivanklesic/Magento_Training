<?php

declare(strict_types=1);

namespace Inchoo\Sample07\Setup\Patch\Data;

use Magento\Catalog\Api\Data\CategoryAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateCustomDescriptionCategoryAttribute implements DataPatchInterface
{
    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * CreateCustomDescriptionCategoryAttribute constructor.
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

        $attributeCode = 'custom_description';
        $entityType = CategoryAttributeInterface::ENTITY_TYPE_CODE;

        $eavSetup->addAttribute($entityType, $attributeCode, [
            'type'         => 'text',
            'input'        => 'textarea',
            'label'        => 'Custom Description',
            'required'     => 0,
            'user_defined' => 1 // required for custom attributes
        ]);

        // add attribute to attribute sets (general-information group)
        foreach ($eavSetup->getAllAttributeSetIds($entityType) as $setId) {
            $groupId = $eavSetup->getAttributeGroupId($entityType, $setId, 'General Information');
            $eavSetup->addAttributeToSet($entityType, $setId, $groupId, $attributeCode);
        }

        return $this;
    }
}
