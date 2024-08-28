<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Créer un utilisateur admin',
)]
class CreateAdminCommand extends Command
{
    private SymfonyStyle $io;

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher, 
        private readonly EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $user->setUsername("Jose.direction@gmail.com");
        $user->setPassword($this->passwordHasher->hashPassword($user,"Jose123!"));
        $user->setRoles(["ROLE_EMPLOYER","ROLE_VETERINAIRE","ROLE_ADMINISTRATION"]);
        $this->em->persist($user);
        $this->em->flush();
        
        return Command::SUCCESS;
    }
}
