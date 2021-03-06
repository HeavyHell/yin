<?php
namespace WoohooLabs\Yin\JsonApi\Exception;

use WoohooLabs\Yin\JsonApi\Schema\Error;
use WoohooLabs\Yin\JsonApi\Schema\ErrorSource;

class FullReplacementProhibited extends JsonApiException
{
    /**
     * @var string
     */
    protected $relationshipName;

    /**
     * @param string $relationshipName
     */
    public function __construct($relationshipName)
    {
        parent::__construct("Full replacement of relationship '$relationshipName' is prohibited!");
        $this->relationshipName = $relationshipName;
    }

    /**
     * @inheritDoc
     */
    protected function getErrors()
    {
        return [
            Error::create()
                ->setStatus(403)
                ->setCode("FULL_REPLACEMENT_PROHIBITED")
                ->setTitle("Full replacement is prohibited")
                ->setDetail($this->getMessage())
                ->setSource(ErrorSource::fromPointer("/data/relationships/$this->relationshipName"))
        ];
    }

    /**
     * @return string
     */
    public function getRelationshipName()
    {
        return $this->relationshipName;
    }
}
