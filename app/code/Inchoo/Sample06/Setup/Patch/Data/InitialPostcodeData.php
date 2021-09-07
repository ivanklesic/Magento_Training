<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Setup\Patch\Data;

use Magento\Framework\Math\Random;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InitialPostcodeData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * @var Random
     */
    protected $random;

    /**
     * InitialPostcodeData constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param Random $random
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        Random $random
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->random = $random;
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
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function apply()
    {
        $countries = ['HR', 'GB', 'US'];

        $data = [];
        for ($i = 1; $i <= 25; $i++) {
            $postcode = $this->random->getRandomString(5);
            $countryKey = array_rand($countries);
            $isEven = $i % 2 === 0;

            $data[] = [
                'code'   => "{$postcode}{$i}",
                'country'  => $countries[$countryKey],
                'city' => $isEven ? $this->random->getRandomString(8) : null
            ];
        }

        $tableName = $this->moduleDataSetup->getTable('inchoo_postcode');

        $this->moduleDataSetup->startSetup();
        $this->moduleDataSetup->getConnection()->delete($tableName);
        $this->moduleDataSetup->getConnection()->insertMultiple($tableName, $data);
        $this->moduleDataSetup->endSetup();

        return $this;
    }
}
