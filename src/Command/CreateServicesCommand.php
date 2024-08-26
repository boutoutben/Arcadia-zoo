<?php

namespace App\Command;

use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:createServices',
    description: 'Add a short description for your command',
)]
class CreateServicesCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
        parent::__construct();
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $services1 = (new Services())->setName("Visite du zoo")
                                     ->setDescription("idou iufapzoe ufpomsfucf s dlf jsdmf lsmdl jksf jezu dzeur zked jf sk xvnv cnc cncn cdf ls fze zr e")
                                     ->setImg("visiteGuidé.jpg");
        
        $services2 = (new Services())->setName("Tour de petit train")
                                     ->setDescription("idou iufapzoe ufpomsfucf s dlf jsdmf lsmdl jksf jezu dzeur zked jf sk xvnv cnc cncn cdf ls fze zr e")
                                     ->setImg("petitTrain.jpg");
        $services3 = (new Services())->setName("Coin restauration")
                                     ->setDescription("idou iufapzoe ufpomsfucf s dlf jsdmf lsmdl jksf jezu dzeur zked jf sk xvnv cnc cncn cdf ls fze zr e")
                                     ->setImg("coinRestauration.jpg");

        $this->em->persist($services1);
        $this->em->persist($services2);
        $this->em->persist($services3);

        $this->em->flush();
        
        return Command::SUCCESS;
    }
}
