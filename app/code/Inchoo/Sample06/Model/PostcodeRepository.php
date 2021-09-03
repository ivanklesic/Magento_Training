<?php

declare(strict_types=1);

namespace Inchoo\Sample06\Model;

use Inchoo\Sample06\Model\PostcodeFactory;
use Inchoo\Sample06\Model\ResourceModel\Postcode as PostcodeResource;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class PostcodeRepository
{
    /**
     * @var PostcodeResource
     */
    protected $postcodeResource;

    /**
     * @var PostcodeFactory
     */
    protected $postcodeFactory;

    /**
     * PostcodeRepository constructor.
     * @param PostcodeResource $postcodeResource
     * @param PostcodeFactory $postcodeFactory
     */
    public function __construct(PostcodeResource $postcodeResource, PostcodeFactory $postcodeFactory)
    {
        $this->postcodeResource = $postcodeResource;
        $this->postcodeFactory = $postcodeFactory;
    }

    /**
     * @param int $id
     * @return Postcode
     * @throws NoSuchEntityException
     */
    public function get(int $id): Postcode
    {
        /** @var Postcode $postcode */
        $postcode = $this->postcodeFactory->create();
        $this->postcodeResource->load($postcode, $id);

        if (!$postcode->getEntityId()) {
            throw new NoSuchEntityException(__('The Postcode with the "%1" id does not exist.', $id));
        }

        return $postcode;
    }

    /**
     * @param Postcode $postcode
     * @return Postcode
     * @throws CouldNotSaveException
     */
    public function save(Postcode $postcode): Postcode
    {
        try {
            $this->postcodeResource->save($postcode);
            return $postcode;
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
    }

    /**
     * @param Postcode $postcode
     * @return void
     * @throws CouldNotDeleteException
     */
    public function delete(Postcode $postcode): void
    {
        try {
            $this->postcodeResource->delete($postcode);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
    }

    /**
     * @param int $id
     * @return void
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): void
    {
        $this->delete($this->get($id));
    }
}
