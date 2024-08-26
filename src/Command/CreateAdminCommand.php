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

    protected function configure(): void
    {
        $this
            ->addArgument('username',InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output):void
    {
        $this->io = new SymfonyStyle($input, $output);
        if(
            null != $input->getArgument("username") &&
            null != $input->getArgument("password")
        ){
            return;
        }

        $this->io->text("Add admin commend interactive wizard");
        $this->askArgument($input, 'username');
        $this->askArgument($input, "password");
    }

    private function askArgument(InputInterface $input, string $name, bool $hidden = false) :void 
    {
        $value = strval($input->getArgument($name));
        if( "" != $value){
            $this->io->text((sprintf('><info>%s</info>:%s', $name, $value)));
        }else{
            $value = match($hidden){
                false => $this->io->ask($name),
                default => $this->io->ask($name)
            };
        }
        $input->setArgument($name, $value);

    }

    protected function interact(InputInterface $input, OutputInterface $output) {
        parent::interact($input,$output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $user->setUsername(strval($input->getArgument('username')));
        $user->setPassword($this->passwordHasher->hashPassword($user,strval($input->getArgument("password"))));
        $user->setRoles(["ROLE_EMPLOYER","ROLE_VETERINAIRE","ROLE_ADMINISTRATION"]);
        $this->em->persist($user);
        $this->em->flush();
        
        return Command::SUCCESS;
    }
}
