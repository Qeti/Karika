<?php

namespace Karika\CoreBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Karika\CoreBundle\Entity\Manager\ApiEntityManager;
use Karika\CoreBundle\Entity\ProductSuperclass as Product;
use Karika\CoreBundle\Form\ProductType;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View as FOSView;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Voryx\RESTGeneratorBundle\Controller\VoryxController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Product controller.
 * @RouteResource("Product")
 */
class ProductRESTController extends FOSRestController
{
    const FORM = ProductType::class;

    /**
     * Get a Product entity
     *
     * @ApiDoc
     * 
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @return Response
     *
     */
    public function getAction(int $id)
    {
        try {
            $entity = $this->container->get('karika.repository.product')->find($id);
            if ($entity) {
                return $entity;
            }
            return FOSView::create('Not Found', Codes::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
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
     * @return Response
     *
     * @QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @QueryParam(name="limit", requirements="\d+", default="20", description="How many notes to return.")
     * @QueryParam(name="order_by", nullable=true, array=true, description="Order by fields. Must be an array ie. &order_by[name]=ASC&order_by[description]=DESC")
     * @QueryParam(name="filters", nullable=true, array=true, description="Filter by fields. Must be an array ie. &filters[id]=3")
     */
    public function cgetAction(ParamFetcherInterface $paramFetcher)
    {
        try {
            $offset = $paramFetcher->get('offset');
            $limit = $paramFetcher->get('limit');
            $order_by = $paramFetcher->get('order_by');
            $filters = !is_null($paramFetcher->get('filters')) ? $paramFetcher->get('filters') : array();

            $em = $this->getDoctrine()->getManager();
            //$entities = $em->getRepository('KarikaCoreBundle:Product')->findBy($filters, $order_by, $limit, $offset);
            $entities = $this->container->get('karika.repository.product')->findBy($filters, $order_by, $limit, $offset);
            if ($entities) {
                return $entities;
            }

            return FOSView::create('Not Found', Codes::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
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
     * @return Response
     *
     */
    public function postAction(Request $request)
    {
        /**
         * @var $em ApiEntityManager
         */
        $em = $this->getDoctrine()->getManager();
        $entityClassName = $this->container->getParameter('karika.entity.product_class');
        $entity = $em->createEntity($entityClassName, json_decode($request->getContent(), true));
        $form = $this->createForm(self::FORM, $entity, array("method" => $request->getMethod()));
        //$this->removeExtraFields($request, $form);
        $form->handleRequest($request);

        //if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $entity;
        //}

        return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
    }
    /**
     * Update a Product entity.
     *
     * @ApiDoc
     * 
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function putAction(Request $request, Product $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $request->setMethod('PATCH'); //Treat all PUTs as PATCH
            $form = $this->createForm(self::FORM, $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();

                return $entity;
            }

            return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
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
     * @param $entity
     *
     * @return Response
     */
    public function patchAction(Request $request, Product $entity)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->putAction($request, $entity);
    }
    /**
     * Delete a Product entity.
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function deleteAction(Request $request, Product $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();

            return null;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
