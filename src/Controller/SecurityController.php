<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Component\HttpFoundation\Response;
use FOS\OAuthServerBundle\Model\ClientManagerInterface;

class SecurityController extends AbstractFOSRestController
{
    /**
     * @var ClientManagerInterface
     */
    private $clientManager;

    /**
     * @param ClientManagerInterface $clientManager
     */
    public function __construct(ClientManagerInterface $clientManager)
    {
        $this->clientManager = $clientManager;
    }

    /**
     * Create Client.
     * @FOSRest\Post("/createClient")
     * @param Request $request
     * @return Response
     */
    public function AuthenticationAction(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        if (empty($data['redirect-uri']) || empty($data['grant-type'])) {
            return $this->handleView($this->view($data));
        }

        $clientManager = $this->clientManager;
        $client = $clientManager->createClient();
        $client->setRedirectUris([$data['redirect-uri']]);
        $client->setAllowedGrantTypes([$data['grant-type']]);
        $clientManager->updateClient($client);

        $rows = [
            'client_id' => $client->getPublicId(),
            'client_secret' => $client->getSecret()
        ];

        return $this->handleView($this->view($rows));
    }
}