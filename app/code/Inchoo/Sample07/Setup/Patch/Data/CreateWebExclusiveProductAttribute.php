<?php

declare(strict_types=1);

namespace Inchoo\Sample07\Setup\Patch\Data;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateWebExclusiveProductAttribute implements DataPatchInterface
{
    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * CreateWebExclusiveProductAttribute constructor.
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

        $attributeCode = 'web_exclusive';
        $entityType = ProductAttributeInterface::ENTITY_TYPE_CODE;

        // create or update attribute
        $eavSetup->addAttribute($entityType, $attributeCode, [
            'type'         => 'int',
            'input'        => 'boolean',
            'label'        => 'Web Exclusive',
            'source'       => Boolean::class,
            'required'     => 0,
            'user_defined' => 1, // required for custom attributes
            'default'      => 0,
        ]);

        // add attribute to attribute sets (default group)
        foreach ($eavSetup->getAllAttributeSetIds($entityType) as $setId) {
            $defaultGroupId = $eavSetup->getDefaultAttributeGroupId($entityType, $setId);
            $eavSetup->addAttributeToSet($entityType, $setId, $defaultGroupId, $attributeCode);
        }

        return $this;
    }
}
