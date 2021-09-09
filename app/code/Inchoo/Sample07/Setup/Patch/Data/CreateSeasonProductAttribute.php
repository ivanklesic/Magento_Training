<?php

declare(strict_types=1);

namespace Inchoo\Sample07\Setup\Patch\Data;

use Inchoo\Sample07\Model\Source\Attribute\Season;
use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateSeasonProductAttribute implements DataPatchInterface
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

        $attributeCode = 'season';
        $entityType = ProductAttributeInterface::ENTITY_TYPE_CODE;

        // create or update attribute
        $eavSetup->addAttribute($entityType, $attributeCode, [
            'type'         => 'varchar',
            'input'        => 'multiselect',
            'label'        => 'Season',
            'required'     => 0,
            'user_defined' => 1, // required for custom attributes
            'searchable'   => 1, // use in Search
            'filterable'   => 1, // use in Layered Navigation
            'filterable_in_search' => 1, // use in Search results Layered Navigation,
            'visible_on_front'     => 1, // visible on product page
            'source' => Season::class,
            'backend' => ArrayBackend::class
        ]);

        $attributeId = $eavSetup->getAttributeId($entityType, $attributeCode);

        // add attribute to attribute sets (default group)
        foreach ($eavSetup->getAllAttributeSetIds($entityType) as $setId) {
            $defaultGroupId = $eavSetup->getDefaultAttributeGroupId($entityType, $setId);
            $eavSetup->addAttributeToSet($entityType, $setId, $defaultGroupId, $attributeId);
        }

        return $this;
    }
}
