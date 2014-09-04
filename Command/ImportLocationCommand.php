<?php
/**
 * Created by PhpStorm.
 * User: mgiustiniani
 * Date: 22/05/14
 * Time: 15.09
 */

namespace Manticora\LocationBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportLocationCommand extends ContainerAwareCommand {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    protected $input;
    protected $output;
    protected function configure()
    {

        $this
            ->setName('location:import')
            ->setDescription('recupera i dati delle province')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will yell in uppercase letters'
            )
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $import = $this->getContainer()->get('manticora_location.import_province');
        $import->import();

        $import = $this->getContainer()->get('manticora_location.import_comuni');
        $import->import();

    }
} 