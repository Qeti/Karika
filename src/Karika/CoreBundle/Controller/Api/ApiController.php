<?php

namespace Karika\CoreBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Karika\CoreBundle\Entity\Manager\ApiEntityManager;
use Karika\CoreBundle\Form\ProductType;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View as FOSView;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Base controller for API.
 */
abstract class ApiController extends FOSRestController
{
    /**
     * @var string Form class name for this controller
     */
    protected $formClassName;

    /**
     * Get Entity class name for this controller
     *
     * @return string
     */
    abstract protected function entityClassName(): string;

    /**
     * Get Form class name for this controller
     *
     * Override this method if necessary
     *
     * @return string
     */
    protected function formClassName(): string
    {
        if ($this->formClassName)
        {
            return $this->formClassName;
        }

        $entityClassName = $this->entityClassName();
        $this->formClassName = substr(str_replace('/Form/', '/Entity/', $entityClassName), 0, -4);

        return $this->formClassName;
    }

    /**
     * Get a Product entity
     *
     * @ApiDoc
     * 
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param int $id
     *
     * @return FOSView|object
     *
     */
    public function getAction(int $id)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository($this->entityClassName())->find($id);
            if ($entity) {
                return $entity;
            }
            return FOSView::create('Not Found', Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get all Product entities.
     * 
     * @ApiDoc
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @return array|FOSView
     *
     * @QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @QueryParam(name="limit", requirements="\d+", default="20", description="How many notes to return.")
     * @QueryParam(name="order_by", nullable=true, map=true, description="Order by fields. Must be an array ie. &order_by[name]=ASC&order_by[description]=DESC")
     * @QueryParam(name="filters", nullable=true, map=true, description="Filter by fields. Must be an array ie. &filters[id]=3")
     */
    public function cgetAction(ParamFetcherInterface $paramFetcher)
    {
        try {
            $offset = $paramFetcher->get('offset');
            $limit = $paramFetcher->get('limit');
            $order_by = $paramFetcher->get('order_by');
            $filters = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('filters') : array();

            $em = $this->getDoctrine()->getManager();
            $entities = $em->getRepository($this->entityClassName())
                ->findBy($filters, $order_by, $limit, $offset);

            if ($entities) {
                return $entities;
            }

            return FOSView::create('Not Found', Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a Product entity.
     *
     * @ApiDoc
     * 
     * @View(statusCode=201, serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     *
     * @return object
     *
     */
    public function postAction(Request $request)
    {
        /**
         * @var $em ApiEntityManager
         */
        $em = $this->getDoctrine()->getManager();

        $data = json_decode($request->getContent(), true);
        $entity = $em->createEntity($this->entityClassName());

        $form = $this->createForm($this->formClassName(), $entity, [
            "method" => $request->getMethod(),
        ]);

        $form->submit($data);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $entity;
        }

        return FOSView::create([
            'errors' => $form->getErrors()
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Update a Product entity.
     *
     * @ApiDoc
     * 
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param int $id
     *
     * @return object
     */
    public function putAction(Request $request, int $id)
    {
        try {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository($this->entityClassName())->find($id);

            $data = json_decode($request->getContent(), true);

            $request->setMethod('PATCH'); //Treat all PUTs as PATCH
            $form = $this->createForm($this->formClassName(), $entity, [
                "method" => $request->getMethod(),
            ]);

            $form->submit($data);

            if ($form->isValid()) {
                $em->flush();

                return $entity;
            }

            return FOSView::create(array('errors' => $form->getErrors()), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Partial Update to a Product entity.
     *
     * @ApiDoc
     * 
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param int $id
     *
     * @return object
     */
    public function patchAction(Request $request, int $id)
    {
        return $this->putAction($request, $id);
    }

    /**
     * Delete a Product entity.
     *
     * @ApiDoc
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param int $id
     *
     * @return null|FOSView
     */
    public function deleteAction(Request $request, int $id)
    {
        try {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository($this->entityClassName())->find($id);
            $em->remove($entity);
            $em->flush();

            return null;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
