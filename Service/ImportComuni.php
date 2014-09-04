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

class ImportComuni {

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
        $path.='Resources/meta/import/elenco_ comuni_italiani_03032014.csv';
    echo $path;





        $em=  $this->registry->getEntityManagerForClass("ManticoraLocationBundle:Zone");
        $repository = $em->getRepository('ManticoraLocationBundle:Zone') ;








        $reader = new \EasyCSV\Reader($path);
        $reader->setDelimiter(';');
$zone =null;
        while ($row = $reader->getRow()) {

           var_dump($row);


            if($prov =      $repository->findOneByOriginalId('IT'.$row['Codice Regione'].$row['Codice Provincia'])) {
                $comune = new Zone();
                $comune->setName($row['Solo denominazione in italiano']);
                $comune->setOriginalId('IT'.$row['Codice Regione'].$row['Codice Provincia'].trim($row['Codice Comune']));
                $comune->setType('COMUNE');
                $comune->setParent($prov);
                $em->persist($comune);

                $em->flush();
            }

        }

    }



} 