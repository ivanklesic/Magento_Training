<?php

declare(strict_types=1);

namespace Inchoo\Sample02\Model;

use Magento\Framework\Serialize\SerializerInterface;

class Sample
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var string
     */
    protected $someString;

    /**
     * @var int
     */
    protected $someInteger;

    /**
     * @var bool
     */
    protected $isTrue;

    /**
     * @var array
     */
    protected $randomArray;

    /**
     * Sample constructor.
     * @param SerializerInterface $serializer
     * @param string $someString
     * @param int $someInteger
     * @param bool $isTrue
     * @param array $randomArray
     */
    public function __construct(
        SerializerInterface $serializer,
        string $someString,
        int $someInteger,
        bool $isTrue,
        array $randomArray
    ) {
        $this->serializer = $serializer;
        $this->someString = $someString;
        $this->someInteger = $someInteger;
        $this->isTrue = $isTrue;
        $this->randomArray = $randomArray;
    }

    /**
     * @return string
     */
    public function getSerializerClassName(): string
    {
        return get_class($this->serializer);
    }

    /**
     * @return string
     */
    public function getSerializedString(): string
    {
        $data = [
            'serializer'  => $this->getSerializerClassName(),
            'someString'  => $this->someString,
            'someInteger' => $this->someInteger,
            'isTrue'      => $this->isTrue,
            'randomArray' => $this->randomArray
        ];

        return (string)$this->serializer->serialize($data);
    }
}
