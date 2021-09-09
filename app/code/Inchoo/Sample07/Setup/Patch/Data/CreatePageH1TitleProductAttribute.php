<?php

declare(strict_types=1);

namespace Inchoo\Sample07\Setup\Patch\Data;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreatePageH1TitleProductAttribute implements DataPatchInterface
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

        $attributeCode = 'page_h1_title';
        $entityType = ProductAttributeInterface::ENTITY_TYPE_CODE;

        // create or update attribute
        $eavSetup->addAttribute($entityType, $attributeCode, [
            'type'         => 'varchar',
            'input'        => 'text',
            'label'        => 'Page H1 Title',
            'required'     => 0,
            'user_defined' => 1
        ]);

        $attributeId = $eavSetup->getAttributeId($entityType, $attributeCode);


        foreach ($eavSetup->getAllAttributeSetIds($entityType) as $setId) {
            $groupId = $eavSetup->getAttributeGroupId($entityType, $setId, 'Search Engine Optimization');
            $eavSetup->addAttributeToSet($entityType, $setId, $groupId, $attributeId);
        }

        return $this;
    }
}
