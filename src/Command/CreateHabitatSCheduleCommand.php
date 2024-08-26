<?php

namespace App\Command;

use App\Entity\AllHabitats;
use App\Entity\Schedule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create_habitat_schedule',
    description: 'Add a short description for your command',
)]
class CreateHabitatSCheduleCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $savane = (new AllHabitats())->setName("La belle savane")
                                     ->setDescription("description")
                                     ->setImg("habitatSavane.jpg");
                                    
        $jungle = (new AllHabitats())->setName("Notre jungle paradisiaque")
                                     ->setDescription("description")
                                     ->setImg("pexels-tarcila-4190917.jpg");

        $marais = (new AllHabitats())->setName("Nos magestueux marais")
                                     ->setDescription("description")
                                     ->setImg("wood-duck-7998725_1280.jpg");
        
        $this->em->persist($savane);
        $this->em->persist($jungle);
        $this->em->persist($marais);
        $this->em->flush();

        $monday = (new Schedule())->setDays("lundi")
                                  ->setSchedule("9h-18h");
        $tuesday = (new Schedule())->setDays("mardi")
                                  ->setSchedule("9h-18h");
        $wednesday = (new Schedule())->setDays("mercredi")
                                     ->setSchedule("9h30-19h");
                                  
        $thursday = (new Schedule())->setDays("jeudi")
                                  ->setSchedule("9h-18h");
        $friday = (new Schedule())->setDays("vendredi")
                                  ->setSchedule("9h-18h");
        $saturday = (new Schedule())->setDays("samedi")
                                    ->setSchedule("10h-20h");
        $sunday = (new Schedule())->setDays("dimanche")
                                  ->setSchedule("10h-19h");
        
        $this->em->persist($monday);
        $this->em->persist($tuesday);
        $this->em->persist($wednesday);
        $this->em->persist($thursday);
        $this->em->persist($friday);
        $this->em->persist($saturday);
        $this->em->persist($sunday);
        $this->em->flush();

        return Command::SUCCESS;
    }
}
