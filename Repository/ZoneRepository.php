<?php
/**
 * Created by PhpStorm.
 * User: mgiustiniani
 * Date: 16/06/14
 * Time: 14.49
 */

namespace Manticora\LocationBundle\Repository;


use FOS\ElasticaBundle\Finder\FinderInterface;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Manticora\RestSportStatsBundle\Repository\AbstractRestRepository;

class ZoneRepository extends AbstractRestRepository{

    protected $finder;

    public function setFinder(FinderInterface $finder) {
        $this->finder = $finder;
    }

    public function findAllPaginated(ParamFetcherInterface $paramFetcher, $user = null) {

        if ($search =$paramFetcher->get('search', null)) {

// Option 1. Returns all users who have example.net in any of their mapped fields
            $results = $this->finder->find($search.'~');

            //return $results;
            $pager = new Pagerfanta(new ArrayAdapter($results));
            $paginatedCollection = $this->getArray($paramFetcher, $pager, $this->getRoute(), $this->getPlural(), array('list'));
            return $paginatedCollection;
        }
        $queryBuilder = $this->DefaultQueryBuilder($paramFetcher);



        $paginatedCollection = $this->getQb($paramFetcher, $queryBuilder, $this->getRoute(), $this->getPlural(), array('list'));
        return $paginatedCollection;
    }
    /**
     * @return string
     */
    protected function getSingular()
    {
        return 'zone';
    }

    /**
     * @return string
     */
    protected function getPlural()
    {
        return 'zones';
    }

    /**
     * @return string
     */
    protected function getRoute()
    {
        return 'get_zones';
    }
}