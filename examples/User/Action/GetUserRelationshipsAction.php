<?php
namespace WoohooLabs\Yin\Examples\User\Action;

use WoohooLabs\Yin\Examples\User\JsonApi\Document\UserDocument;
use WoohooLabs\Yin\Examples\User\JsonApi\Resource\ContactResourceTransformer;
use WoohooLabs\Yin\Examples\User\JsonApi\Resource\UserResourceTransformer;
use WoohooLabs\Yin\Examples\User\Repository\UserRepository;
use WoohooLabs\Yin\JsonApi\JsonApi;
use WoohooLabs\Yin\JsonApi\Request\Request;
use WoohooLabs\Yin\JsonApi\Response\FetchRelationshipResponse;

class GetUserRelationshipsAction
{
    /**
     * @param \WoohooLabs\Yin\JsonApi\JsonApi $jsonApi
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(JsonApi $jsonApi)
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            die("You must define the 'id' query parameter with a value of '1' or '2'!");
        }

        if (isset($_GET["relationship"])) {
            $relationshipName = $_GET["relationship"];
        } else {
            die("You must define the 'relationship' query parameter with a value of 'contacts'!");
        }

        $resource = UserRepository::getUser($id);

        $document = new UserDocument(new UserResourceTransformer(new ContactResourceTransformer()));

        return $jsonApi->fetchRelationshipResponse($relationshipName, "")->ok($document, $resource);
    }
}