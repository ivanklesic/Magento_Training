<?php

declare(strict_types=1);

namespace Inchoo\Sample05\Setup\Patch\Data;

use Magento\Framework\Math\Random;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InitialEventData implements DataPatchInterface
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
     * InitialEventData constructor.
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
            $randomNumber = Random::getRandomNumber(10, 20);

            $data[] = [
                'title'       => $this->random->getRandomString(8),
                'status'      => $i % 2 === 0, // even events are enabled
                'description' => $this->random->getRandomString(64),
                'event_url'   => $randomNumber > 15 ? $this->generateRandomUrl() : null,
                'start_date'  => "2021-{$i}-1",
                'end_date'    => "2021-{$i}-{$randomNumber}"
            ];
        }

        $tableName = $this->moduleDataSetup->getTable('inchoo_event');

        $this->moduleDataSetup->startSetup();
        $this->moduleDataSetup->getConnection()->delete($tableName);
        $this->moduleDataSetup->getConnection()->insertMultiple($tableName, $data);
        $this->moduleDataSetup->endSetup();

        return $this;
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function generateRandomUrl(): string
    {
        $chars = Random::CHARS_LOWERS . '-';
        $domainName = $this->random->getRandomString(8, $chars);
        return "https://www.{$domainName}.com";
    }
}
