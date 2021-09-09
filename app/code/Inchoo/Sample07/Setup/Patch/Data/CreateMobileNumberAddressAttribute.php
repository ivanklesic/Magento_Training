<?php

declare(strict_types=1);

namespace Inchoo\Sample07\Setup\Patch\Data;

use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateMobileNumberAddressAttribute implements DataPatchInterface
{
    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * CreateMobileNumberAddressAttribute constructor.
     * @param EavSetupFactory $eavSetupFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
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

        $attributeCode = 'mobile_number';
        $entityType = AddressMetadataInterface::ENTITY_TYPE_ADDRESS;
        $setId = AddressMetadataInterface::ATTRIBUTE_SET_ID_ADDRESS;

        $eavSetup->addAttribute($entityType, $attributeCode, [
            'type'           => 'varchar',
            'input'          => 'text',
            'label'          => 'Mobile Number',
            'required'       => 0,
            'user_defined'   => 1, // required for custom attributes
            'system'         => 0, // required for custom attributes
            'sort_order'     => 125, // position in a attribute group
            'position'       => 125, // position in a adminhtml form
            'validate_rules' => '{"max_text_length":255}'
        ]);

        $attributeId = (int)$eavSetup->getAttributeId($entityType, $attributeCode);

        // add attribute to attribute set (default group)
        $defaultGroupId = $eavSetup->getDefaultAttributeGroupId($entityType, $setId);
        $eavSetup->addAttributeToSet($entityType, $setId, $defaultGroupId, $attributeId);

        $this->createFormAttributeRelations($attributeId);

        return $this;
    }

    protected function createFormAttributeRelations(int $attributeId): void
    {
        $formAttributeTable = $this->moduleDataSetup->getTable('customer_form_attribute');

        // clean existing attribute/form relations
        $this->moduleDataSetup->getConnection()->delete($formAttributeTable, ['attribute_id = ?' => $attributeId]);

        $usedInForms = [
            'adminhtml_customer_address',
            'customer_address_edit',
            'customer_register_address'
        ];

        $formAttributeData = [];
        foreach ($usedInForms as $formCode) {
            $formAttributeData[] = ['form_code' => $formCode, 'attribute_id' => $attributeId];
        }

        // create attribute/form relations
        $this->moduleDataSetup->getConnection()->insertMultiple($formAttributeTable, $formAttributeData);
    }
}
