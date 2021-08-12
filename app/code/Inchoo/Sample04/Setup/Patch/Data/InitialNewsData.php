<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Setup\Patch\Data;

use Magento\Framework\Math\Random;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InitialNewsData implements DataPatchInterface
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
     * InitialNewsData constructor.
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
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'title'   => $this->random->getRandomString(8),
                'status'  => $i % 2 === 0, // even news are enabled
                'content' => $this->random->getRandomString(64)
            ];
        }

        $tableName = $this->moduleDataSetup->getTable('inchoo_news');

        $this->moduleDataSetup->startSetup();
        $this->moduleDataSetup->getConnection()->delete($tableName);
        $this->moduleDataSetup->getConnection()->insertMultiple($tableName, $data);
        $this->moduleDataSetup->endSetup();

        return $this;
    }
}
