<?php

namespace App\Controller;

use App\Form\FilterAvisAdministrationType;
use App\Form\RegisterType;
use App\Repository\AnimalRepository;
use App\Repository\RapportVeterinaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Date;

class AdministrationPageController extends AbstractController
{
    private RapportVeterinaireRepository $rapportVeterinaireRepository;
    private AnimalRepository $animalRepository;

    public function __construct(RapportVeterinaireRepository $rapportVeterinaireRepository, AnimalRepository $animalRepository) {
        $this->rapportVeterinaireRepository = $rapportVeterinaireRepository;
        $this->animalRepository = $animalRepository;
    }

    #[Route('/administration', name: 'app_administration_page')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $nameAnimal = $request->request->get("name")??"";
        $dateString = $request->request->get('date')??"";
        
        $info = null;
        $form = $this->createForm(RegisterType::class, $info,[
            "action" => $this->generateUrl('app_register'),
            "method" => 'POST'
        ]);
        $filterAvisAdministration = $this->createForm(FilterAvisAdministrationType::class, null, [
            "method" => "post",
            "action" => "/administration#rappportsVet",
        ]);
        $rapportVeterinaire = null;
        if($dateString != "") 
        {
            $rapportVeterinaire =$this->rapportVeterinaireRepository->createQueryBuilder('o')
            ->where('o.Date LIKE :date')
            ->setParameter('date', $dateString."%")
            ->getQuery()
            ->getResult();
        }
        elseif($nameAnimal != "")
        {
            $Animal = $this->animalRepository->findOneBy(["name" => $nameAnimal]);
            $rapportVeterinaire = $this->rapportVeterinaireRepository->findBy(["animal" => $Animal]);
        }
        
        $allAnimaux = $this->animalRepository->findAll();

        return $this->render('administration_page/index.html.twig', [
            "form" => $form,
            "rapportVeterinaire" => $rapportVeterinaire,
            "filterAvisAdministration" => $filterAvisAdministration,
            "allAnimaux" => $allAnimaux,
        ]);
    }

    #[Route("click/{id}", "app_click")]
    public function Click($id, EntityManagerInterface $em, Request $request): Null
    {
        $animal = $this->animalRepository->findOneBy(["id" => $id]);
        $nbClick = $animal->getNbClick();
        $animal->setNbClick($nbClick + 1 );
        $em->flush();
        
        header('Location: ' . $_SERVER["HTTP_REFERER"] );
        usleep(7000000);
        exit;
        
    }
}
