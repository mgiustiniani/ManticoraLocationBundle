<?php
/**
 * Created by PhpStorm.
 * User: mgiustiniani
 * Date: 22/05/14
 * Time: 15.08
 */

namespace Manticora\LocationBundle\Service;


use Manticora\LocationBundle\Entity\Zone;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ImportProvince {

    protected $kernel;
    /**
     * @var \Symfony\Bridge\Doctrine\RegistryInterface
     */
    protected $registry;
    public function __construct($kernel, RegistryInterface $registry) {

        $this->kernel = $kernel;
        $this->registry = $registry;
    }

    public function import() {
       $path= $this->kernel->locateResource('@ManticoraLocationBundle');
        $path.='Resources/meta/import/ripartizioni_regioni_province.csv';
    echo $path;





        $em=  $this->registry->getEntityManagerForClass("ManticoraLocationBundle:Zone");
        $repository = $em->getRepository('ManticoraLocationBundle:Zone') ;


        for ($i = 9 ; $i>= 0 ;$i--)
        {
            $q = $em->createQuery('delete from  ManticoraLocationBundle:Zone z where z.lvl = '.$i);
            $numUpdated = $q->execute();
        }


        /**
         * @var Connection
         */
        //;$this->registry->getConnection()->getSchemaManager()

   //     $q = $em->createQuery('alter table ManticoraLocationBundle:Zone AUTO_INCREMENT = 1');
     //   $numUpdated = $q->execute();

        $zone1 = new Zone();
        $zone1->setName("Multiverse");
        $zone1->setType('MULTIVERSE');
        $em->persist($zone1);

        $em->flush();

        $zone2 = new Zone();
        $zone2->setName("Universe");
        $zone2->setType('UNIVERSE');
        $zone2->setParent($zone1);
        $em->persist($zone2);

        $em->flush();

        $zone3 = new Zone();
        $zone3->setName("Milky Way");
        $zone3->setType('GALAXY');
        $zone3->setParent($zone2);
        $em->persist($zone3);

        $em->flush();
        $zone4 = new Zone();
        $zone4->setName("Solar System");
        $zone4->setType('PLANETARY_SYSTEM');
        $zone4->setParent($zone3);
        $em->persist($zone4);

        $em->flush();




        $zone5 = new Zone();
        $zone5->setName("Mercury");
        $zone5->setType('PLANET');
        $zone5->setParent($zone4);
        $em->persist($zone5);

        $em->flush();

        $zone5 = new Zone();
        $zone5->setName("Venus");
        $zone5->setType('PLANET');
        $zone5->setParent($zone4);
        $em->persist($zone5);

        $em->flush();

        $zone5 = new Zone();
        $zone5->setName("Mars");
        $zone5->setType('PLANET');
        $zone5->setParent($zone4);
        $em->persist($zone5);

        $em->flush();

        $zone5 = new Zone();
        $zone5->setName("Jupiter");
        $zone5->setType('PLANET');
        $zone5->setParent($zone4);
        $em->persist($zone5);

        $em->flush();

        $zone5 = new Zone();
        $zone5->setName("Saturn");
        $zone5->setType('PLANET');
        $zone5->setParent($zone4);
        $em->persist($zone5);
        $em->flush();
        $zone5 = new Zone();
        $zone5->setName("Uranus");
        $zone5->setType('PLANET');
        $zone5->setParent($zone4);
        $em->persist($zone5);

        $em->flush();

        $zone5->setName("Neptune");
        $zone5->setType('PLANET');
        $zone5->setParent($zone4);
        $em->persist($zone5);

        $em->flush();

        $zone5 = new Zone();
        $zone5->setName("Earth");
        $zone5->setType('PLANET');
        $zone5->setParent($zone4);
        $em->persist($zone5);



        $em->flush();

        $zone6 = new Zone();
        $zone6->setName("Europe");
        $zone6->setType('CONTINENT');
        $zone6->setParent($zone5);
        $em->persist($zone6);



        $em->flush();

        $zone7 = new Zone();
        $zone7->setName("Italy");
        $zone7->setType('STATE');
        $zone7->setParent($zone6);
        $em->persist($zone7);



        $em->flush();



        $reader = new \EasyCSV\Reader($path);
        $reader->setDelimiter(';');
$zone =null;
        while ($row = $reader->getRow()) {

           if(!$zone =      $repository->findOneByOriginalId('IT'.sprintf("%02d",$row['Codice regione']))) {
               $zone = new Zone();
               $zone->setName($row['Denominazione regione']);
               $zone->setOriginalId('IT'.sprintf("%02d",$row['Codice regione']));
               $zone->setType('REGIONE');
               $zone->setParent($zone7);

               $em->persist($zone);

               $em->flush();
           }

            if(!$prov =      $repository->findOneByOriginalId('IT'.sprintf("%02d",$row['Codice regione']).sprintf("%03d",$row['Codice provincia']))) {
                $prov = new Zone();
                $prov->setName($row['Denominazione provincia']);
                $prov->setOriginalId('IT'.sprintf("%02d",$row['Codice regione']).sprintf("%03d",$row['Codice provincia']));
                $prov->setType('PROVINCIA');
                $prov->setParent($zone);
                $em->persist($prov);

                $em->flush();
            }

        }

    }



} 