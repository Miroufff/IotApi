<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sensor;
use AppBundle\Form\SensorType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Voryx\RESTGeneratorBundle\Controller\VoryxController;
use Symfony\Component\HttpFoundation\JsonResponse;


class SensorController extends Controller
{
    /**
     * @ApiDoc(
     *  description="Update the status of a sensor",
     *  input="AppBundle\Form\SensorType",
     *  output="AppBundle\Entity\Sensor"
     * )
     *
     * @param Request $request
     * @param Sensor $sensor
     *
     * @return JsonResponse
     */
    public function updateStatusAction(Request $request, Sensor $sensor) {
        $sensor->setEnable(!$sensor->getEnable());
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse();
    }
}
