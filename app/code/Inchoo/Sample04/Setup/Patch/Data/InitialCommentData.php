<?php

declare(strict_types=1);

namespace Inchoo\Sample04\Setup\Patch\Data;

use Magento\Framework\Math\Random;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Inchoo\Sample04\ViewModel\News;

class InitialCommentData implements DataPatchInterface
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
     * @var News
     */
    protected $newsViewModel;

    /**
     * InitialNewsData constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param Random $random
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        Random $random,
        News $newsViewModel
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->random = $random;
        $this->newsViewModel = $newsViewModel;
    }

    /**
     * @return string[]
     */
    public static function getDependencies()
    {
        return [InitialNewsData::class];
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
        $newsCollection = $this->newsViewModel->getNewsList(true);
        $data = [];

        foreach($newsCollection as $newsItem) {
            for ($i = 1; $i <= 5; $i++) {
                $data[] = [
                    'news_id'   => $newsItem->getId(),
                    'comment'  => $this->random->getRandomString(64)
                ];
            }
        }


        $tableName = $this->moduleDataSetup->getTable('inchoo_news_comment');

        $this->moduleDataSetup->startSetup();
        $this->moduleDataSetup->getConnection()->delete($tableName);
        $this->moduleDataSetup->getConnection()->insertMultiple($tableName, $data);
        $this->moduleDataSetup->endSetup();

        return $this;
    }
}
