<?php
/**
 * Created by PhpStorm.
 * User: mgiustiniani
 * Date: 16/06/14
 * Time: 14.46
 */

namespace Manticora\LocationBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Manticora\LocationBundle\Entity\Zone;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * Class ZoneController
 * @package Manticora\LocationBundle\Controller
 * @Rest\RouteResource("Zone")
 */
class ZoneController extends Controller {
    protected function getRepository(){
        return $this->getManager()->getRepository('ManticoraLocationBundle:Zone');
    }

    protected function getManager(){
        return $this->getDoctrine()->getManagerForClass('ManticoraLocationBundle:Zone');
    }

    /**
     *
     * Lista dei comuni
     *
     *
     * @Rest\QueryParam(name="limit", requirements="\d+", default="10", description="Page of the overview.")
     * @Rest\QueryParam(name="search",  description="cerca la squadra")
     * @Rest\QueryParam(name="page", requirements="\d+", default="1", description="Page of the overview.")
     *
     * @ApiDoc(
     *  section="Social Network",
     *  resource=true,
     *  description="lista comuni",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     403 = "Returned when the client is not authorized"
     *   }
     * )
     * @Rest\View(statusCode=200, serializerGroups="list")
     */
    public function cgetAction( ParamFetcherInterface $paramFetcher)
    {

        $this->getRepository()-> setFinder( $this->container->get('fos_elastica.finder.search.zone'));
        return $this->getRepository()->findAllPaginated($paramFetcher);




        return $paginatedCollection;
    }

    /**
     *
     *
     * @ApiDoc(
     *  section="Social Network",
     *  resource=false,
     *  description="dettaglio comune",
     *  output = {
     *     "class" = "Manticora\SportStatsBundle\Entity|Team",
     *     "groups" = {"update", "detail"}
     *  },
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the team is not found",
     *     403="Returned when the client is not authorized"
     *   }
     * )
     * @Rest\View(statusCode=200, serializerGroups="detail")
     */
    public function getAction(Zone $zone)
    {

        return $zone;
    }
} 