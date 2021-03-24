<?php

namespace srag\Plugins\M365File\M365;

use srag\Plugins\M365File\Utils\M365FileTrait;
use Microsoft\Graph\Graph;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Microsoft\Graph\Exception\GraphException;
use Microsoft\Graph\Http\GraphResponse;
use stdClass;

/**
 * Client for Microsoft Graph API (i.e. some file endpoints)
 * @author  Theodor Truffer <tt@studer-raimann.ch>
 */
class RESTClient
{

    use M365FileTrait;

    const BASE_URL = "/me/drive/items";

    /**
     * @var OAuth2Service
     */
    private $oauth2Service;

    /**
     * RESTClient constructor.
     * @param OAuth2Service $oauth2Service
     */
    public function __construct(OAuth2Service $oauth2Service)
    {
        $this->oauth2Service = $oauth2Service;
    }

    /**
     * @param string $name
     * @param string $parent_id
     * @return GraphResponse|mixed
     * @throws IdentityProviderException
     * @throws GraphException
     */
    public function createFolder(string $name, string $parent_id = 'root') : GraphResponse
    {
        $this->log()->info("creating folder with name '$name' in parent directory '$parent_id'");
        return $this->getGraph()
                    ->createRequest("POST", self::BASE_URL . "/{$parent_id}/children")
                    ->attachBody([
                        "name" => $name,
                        "folder" => new stdClass(),
                        "@microsoft.graph.conflictBehavior" => "fail"
                    ])->execute();
    }

    /**
     * @param string $file_path
     * @param string $file_name
     * @param string $target_path
     * @return GraphResponse
     * @throws GraphException
     * @throws IdentityProviderException
     */
    public function uploadFile(string $file_path, string $file_name, string $target_path) : GraphResponse
    {
        $this->log()->info("creating file with name '$file_name' in parent directory '$target_path'");
        // TODO: test files > 4MB
        return $this->getGraph()
                    ->createRequest("PUT", self::BASE_URL . "/root:/{$target_path}/{$file_name}:/content")
                    ->attachBody([
                        "name" => $file_name,
                        "file" => new stdClass(),
                        "@microsoft.graph.conflictBehavior" => "fail"
                    ])->upload($file_path);
    }

    public function createSharingLink(string $item_id) : string
    {
        return $this->getGraph()
                    ->createRequest("POST", self::BASE_URL . "/{$item_id}/createLink")
                    ->attachBody([
                        "type" => "edit",
                        "scope" => "organization"
                    ])->execute()
                    ->getBody()["link"]["webUrl"];
    }

    /**
     * @return Graph
     * @throws IdentityProviderException
     */
    private function getGraph() : Graph
    {
        $graph = new Graph();
        $graph->setAccessToken($this->oauth2Service->getAccessToken()->getAccessToken());
        return $graph;
    }

}
