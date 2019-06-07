<?php

namespace App\Controller;

use App\Domain\Exception\ShapeNotFoundException;
use App\Domain\Service\ShapeService;
use App\Response\ApiHttpCreatedResponse;
use App\Response\ApiHttpNoContentResponse;
use App\Response\ApiHttpNotFoundResponse;
use App\Response\ApiHttpOkResponse;
use App\Response\ApiHttpResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/api", name="api_")
 */
class ShapeController extends AbstractFOSRestController
{
    /**
     * @var ShapeService
     */
    private $shapeService;

    /**
     * @param ShapeService $shapeService
     */
    public function __construct(ShapeService $shapeService)
    {
        $this->shapeService = $shapeService;
    }

    /**
     * @Rest\Get("/shapes/{shape_slug}")
     *
     * @param string $shape_slug
     * @return ApiHttpResponse
     */
    public function getShapesListAction(string $shape_slug): ApiHttpResponse
    {
        try {
            $shapes = $this->shapeService->getList($shape_slug);
        } catch (ShapeNotFoundException $shapeNotFoundException) {
            return new ApiHttpNotFoundResponse();
        }

        return new ApiHttpOkResponse($shapes->toArray());
    }

    /**
     * @Rest\Get("/shapes/{shape_slug}/{id}")
     *
     * @param string $shape_slug
     * @param int $id
     * @return ApiHttpResponse
     */
    public function getShapesAction(string $shape_slug, int $id): ApiHttpResponse
    {
        try {
            $shape = $this->shapeService->get($shape_slug, $id);
        } catch (ShapeNotFoundException $shapeNotFoundException) {
            return new ApiHttpNotFoundResponse();
        }

        return new ApiHttpOkResponse($shape->toArray());
    }

    /**
     * @Rest\Post("/shapes")
     *
     * @param Request $request
     * @return ApiHttpResponse
     */
    public function postShapeAction(Request $request) : ApiHttpResponse
    {
        try {
            $this->shapeService->create($request->request->all());
        } catch (\Exception $shapeNotFoundException) {
            return new ApiHttpNotFoundResponse();
        }

        return new ApiHttpCreatedResponse();
    }

    /**
     * @Rest\Put("/shapes/{id}")
     *
     * @param int $id
     * @param Request $request
     * @return ApiHttpResponse
     */
    public function updateShapeAction(int $id, Request $request) : ApiHttpResponse
    {
        try {
            $this->shapeService->update($id, $request->request->all());
        } catch (\Exception $shapeNotFoundException) {
            return new ApiHttpNotFoundResponse();
        }

        return new ApiHttpNoContentResponse();
    }

    /**
     * @Rest\Delete("/shapes/{shape_slug}/{id}")
     *
     * @param string $shape_slug
     * @param int $id
     * @return ApiHttpResponse
     */
    public function deleteShapeAction(string $shape_slug, int $id) : ApiHttpResponse
    {
        try {
            $this->shapeService->delete($shape_slug, $id);
        } catch (\Exception $shapeNotFoundException) {
            return new ApiHttpNotFoundResponse();
        }

        return new ApiHttpNoContentResponse();
    }
}