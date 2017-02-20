<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use InfluxDB\Point;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $time = new \DateTime();
	$points = $this->get("influxdb_database")->writePoints([new Point(
	   'test_metric', // name of the measurement
	    0.64, // the measurement value
	    ['host' => 'server01', 'region' => 'italy'], // optional tags
	    ['cpucount' => rand(1,100), 'memory' => memory_get_usage(true)], // optional additional fields
	    $time->getTimestamp()
	)]);



	// replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
}
