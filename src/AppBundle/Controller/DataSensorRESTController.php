<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DataSensor;
use AppBundle\Form\DataSensorType;
use Doctrine\Common\Collections\ArrayCollection;
use InfluxDB\Point;
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
use Voryx\RESTGeneratorBundle\Controller\VoryxController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use DateTime;

/**
 * DataSensor controller.
 * @RouteResource("DataSensor")
 */
class DataSensorRESTController extends VoryxController
{
    /**
     * REST action which returns type by id.
     * Method: GET, url: /api/datasensor/{idSensor}.{_format}
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Get a sensor data",
     *   output = "AppBundle\Entity\DataSensorType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     *
     * @View(statusCode=201, serializerEnableMaxDepthChecks=true)
     *
     * @param $idSensor
     *
     * @return Response
     */
    public function getAction($idSensor)
    {
        try {
            $temperature = $this->container->get('influxdb_database')->getQueryBuilder()
                ->select('last(value)')
                ->from('temperature')
                ->where(["sensor = '".$idSensor."'"])
                ->getResultSet()
                ->getPoints()[0];

            $humidity = $this->container->get('influxdb_database')->getQueryBuilder()
                ->select('last(value)')
                ->from('humidity')
                ->where(["sensor = '".$idSensor."'"])
                ->getResultSet()
                ->getPoints()[0];

            $dust = $this->container->get('influxdb_database')->getQueryBuilder()
                ->select('last(value)')
                ->from('dust')
                ->where(["sensor = '".$idSensor."'"])
                ->getResultSet()
                ->getPoints()[0];

            $airquality = $this->container->get('influxdb_database')->getQueryBuilder()
                ->select('last(value)')
                ->from('airquality')
                ->where(["sensor = '".$idSensor."'"])
                ->getResultSet()
                ->getPoints()[0];

            return new JsonResponse(array(
                "temperature" => $temperature,
                "humidity"    => $humidity,
                "dust"        => $dust,
                "airquality"  => $airquality
            ));
        } catch (\Exception $e) {
            return new JsonResponse(array("message" => $e->getMessage()));
        }
    }
    
    /**
     * Get all DataSensor entities.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @return Response
     */
    public function cgetAction()
    {
        return $this->get("influxdb_database")->query('select * from test_metric LIMIT 5')->getPoints();
    }

    /**
     * REST action which returns type by id.
     * Method: GET, url: /api/datasensor/{request}.{_format}
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Push a sensor data",
     *   output = "AppBundle\Entity\DataSensorType",
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
     *
     */
    public function postAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sensor = $em->getRepository('AppBundle:Sensor')->findOneBy(array("uuid" => $request->request->get('sensor', '')));

        if ($sensor) {
            $this->container->get('app.influx_service')->persist(
                $request->request->get('type', ""),
                $request->request->get('value', 0),
                $sensor,
                $request->request->get('receivedAt', exec('date +%s%N'))
            );

            return new JsonResponse("ok");
        } else {
            return new JsonResponse("nok");
        }
    }    
}
