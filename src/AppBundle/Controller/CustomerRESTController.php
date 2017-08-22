<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use AppBundle\Form\CustomerType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View as FOSView;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Voryx\RESTGeneratorBundle\Controller\VoryxController;

/**
 * Customer controller.
 * @RouteResource("Customer")
 */
class CustomerRESTController extends VoryxController
{
    /**
     * Get a Customer entity
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @return Response
     *
     */
    public function getAction(Customer $entity)
    {
        return $entity;
    }

    /**
     * Get all Customer entities.
     *
     * REST action which returns type by id.
     * Method: POST, url: /api/customers
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Retrieve customers data",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param ParamFetcherInterface $paramFetcherall
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
            $entities = $em->getRepository('AppBundle:Customer')->findBy($filters, $order_by, $limit, $offset);
            if ($entities) {
                return $entities;
            }

            return FOSView::create('Not Found', Codes::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a Customer entity.
     *
     * REST action which returns list of custumers.
     * Method: POST, url: /api/customers/{request}.{_format}
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Push a customer data",
     *   output = "AppBundle\Entity\CustomerType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     *
     * @View(statusCode=201, serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postAction(Request $request, Customer $customer = null)
    {
        $data = $request->request->all();
        $userManager = $this->get('fos_user.user_manager');

        if ($customer == null) {
            $customer = $userManager->createUser();
        }

        $customer->setUsername($data['username']);
        $customer->setFirstname($data['firstname']);
        $customer->setLastname($data['lastname']);
        $customer->setEmail($data['email']);
        if ($data['password'] != "") {
            $customer->setPlainPassword($data['password']);
        }
        $customer->setEnabled(true);

        $form = $this->createForm(CustomerType::class, $customer, array("method" => $request->getMethod()));
        $this->removeExtraFields($request, $form);
        $form->handleRequest($request);

        if ($form->isValid()) {
            try {
                $userManager->updateUser($customer, true);

                return new JsonResponse(array("code" => 200));
            } catch (\Exception $e) {
                if ($e->getErrorCode() == 1062) {
                    return new JsonResponse(array("code" => 1062, "message" => "Duplicate entry."));
                }

                return new JsonResponse(
                    array(
                        'status'  => $e->getErrorCode(),
                        'message' => $e->getMessage()
                    )
                );
            }
        }

        return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Update a Customer entity.
     *
     * REST action which update a user.
     * Method: POST, url: /api/customers/{request}.{_format}
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Update a customer data",
     *   output = "AppBundle\Entity\CustomerType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request  $request
     * @param Customer $customer
     *
     * @return Response
     */
    public function putAction(Request $request, Customer $customer)
    {
        $data = $request->request->all();
        $customer->setPlainPassword($data['password']);

        $form = $this->container->get('fos_user.change_password.form');
        $formHandler = $this->container->get('fos_user.change_password.form.handler');
        $process = $formHandler->process($customer);

        if ($process) {
            return new JsonResponse();
        }

        return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Partial Update to a Customer entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function patchAction(Request $request, Customer $entity)
    {
        return $this->putAction($request, $entity);
    }

    /**
     * Delete a Customer entity.
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function deleteAction(Request $request, Customer $entity)
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
