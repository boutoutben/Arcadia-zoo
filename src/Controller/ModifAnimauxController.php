<?php

namespace App\Controller;

use App\Entity\AllHabitats;
use App\Entity\Animal;
use App\Entity\Races;
use App\Form\ChoiceModifType;
use App\Form\ModifAnimalCreateType;
use App\Form\ModifAnimalDeleteType;
use App\Form\ModifAnimalUpdateType;
use App\Repository\AllHabitatsRepository;
use App\Repository\AnimalRepository;
use App\Repository\RacesRepository;
use App\Repository\RapportVeterinaireRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Validator\Constraints\Date;
use MongoDB;

#[Route('/modifAnimaux', name: 'app_modif_animaux_')]
class ModifAnimauxController extends AbstractController
{
    private AnimalRepository $AnimalRepository;
    private RouterInterface $router;
    private RacesRepository $RacesRepository;
    private AllHabitatsRepository $allHabitatsRepository;
    private RapportVeterinaireRepository $RapportVeterinaireRepository;

    public function __construct(AnimalRepository $AnimalRepository, RouterInterface $router, RacesRepository $racesRepository, AllHabitatsRepository $allHabitatsRepository, RapportVeterinaireRepository $RapportVeterinaireRepository)
    {
        $this->AnimalRepository = $AnimalRepository;
        $this->router = $router;
        $this->RacesRepository = $racesRepository;
        $this->allHabitatsRepository = $allHabitatsRepository;
        $this->RapportVeterinaireRepository = $RapportVeterinaireRepository;
    }

    #[Route('/index/{id_habitat}', name: 'index')]
    public function index($id_habitat, ManagerRegistry $mr): Response
    {
        $animal = null;
        $choice = $_POST["choice"] ?? '';

        $form = $this->createForm(ModifAnimalCreateType::class,$animal,[
            "action" => $this->generateUrl('app_modif_animaux_create', ["id_habitat"=> $id_habitat]),
            "method"=>"POST",
        ]);
        $formUpdate = $this->createForm(ModifAnimalUpdateType:: class, $animal,[
            "action" => $this->generateUrl('app_modif_animaux_update',["id_habitat"=> $id_habitat]),
            "method"=>"POST",
        ]);

        $formDelete = $this->createForm(ModifAnimalDeleteType:: class, $animal,[
            "action" => $this->generateUrl('app_modif_animaux_delete',["id_habitat"=> $id_habitat]),
            "method"=>"POST",
        ]);

        return $this->render('modif_animaux/index.html.twig', [
            "form" => $form,
            "choice" => $choice,
            "formUpdate" => $formUpdate,
            "formDelete" => $formDelete,
            "title" => "modier les habitats",
            "actionName" => "/modifAnimaux/index/{$id_habitat}",
            "namePlace" => "animal"
        ]);
    }


    #[Route('/create/{id_habitat}', name: 'create')]
    public function create(Request $request, EntityManagerInterface $em, $id_habitat):Response
    {
        $animal = new Animal();
        $raceEntity = new Races();
        $name = $request->request->get('name');
        $etat = $request->request->get("etat");
        $race = $request->request->get("race");
        $image = $request->files->get("image");
        $uploadDir = $this->getParameter('upload_directory');
            
            try {
                $image->move($uploadDir, $image->getClientOriginalName());
                // Success logic here
            } catch (FileException $e) {
                // Handle exception if something happens during file upload
            }

        if(isset($name)&& isset($etat)&&isset($race)){
            $animal->setName(htmlspecialchars($name));
            $animal->setEtat(htmlspecialchars($etat));
            $animal->setImg($image->getClientOriginalName());
            $now = new DateTime();
            $animal->setDate($now);
            if($this->RacesRepository->findOneBy(['label' => $race]) == null)
            {
                $raceEntity->setLabel($race);
                $em->persist($raceEntity);
                $em->flush();
                $raceEntity = $this->RacesRepository->findOneBy(['label' => $race]);
                $animal->setRace($raceEntity);
                $habitat = $this->allHabitatsRepository->findOneBy(["id" => $id_habitat]);
                $animal->setHabitats($habitat);
            }
            else{
                $habitat = $this->allHabitatsRepository->findOneBy(["id" => $id_habitat]);
                $animal->setHabitats($habitat);
                $raceEntity = $this->RacesRepository->findOneBy(['label' => $race]);
                $animal->setRace($raceEntity);
            }
            
            $collection = (new MongoDB\Client(getenv('MONGODB_URI')))->arcadia->animal;
            $collection->insertOne(['name'=>$name,"race"=>$race, "nbClick"=>0]);
            $em->persist($animal);
            $em->flush();

            return new RedirectResponse(
                $this->router->generate('app_home')
            );
        }
    }

    #[Route('/update', name: 'update')]
    public function update(Request $request, EntityManagerInterface $em):Response
    {
        $animal = new Animal();
        $nameToChange = $request->request->get('nameToChange');
        $name = $request->request->get('name');
        $etat = $request->request->get("etat");
        $raceToChange = $request->request->get("raceToChange");
        $race = $request->request->get("race");
        $image = $request->files->get("image");
        $uploadDir = $this->getParameter('upload_directory');

        if(isset($nameToChange)){
            $animal = $this->AnimalRepository->findOneBy(['name' => $nameToChange]);
            if($animal != null)
            {
                if($name != ""){
                    $animal->setName(htmlspecialchars($name));
    
                }
                if($etat != ""){
                    $animal->setEtat(htmlspecialchars($etat));
                }
                if($race != "" && $raceToChange != "")
                {
                    $raceEntity = $this->RacesRepository->findOneBy(['label'=> $raceToChange]);
                    if($race != null)
                    {
                        $raceEntity->setLabel(htmlspecialchars($race));
                    }
                    
                }
                if(isset($image)){
                    try {
                        $image->move($uploadDir, $image->getClientOriginalName());
                        // Success logic here
                    } catch (FileException $e) {
                        // Handle exception if something happens during file upload
                    }
                    $animal->setImg($image->getClientOriginalName());
                }
                    
                    
                $em->flush();
    
                return new RedirectResponse(
                    $this->router->generate('app_home')
                );
            }
            else{
                return $this->render("bundles/TwigBundle/Exception/NotFoundName.html.twig");
            }
        }
           

    }

    #[Route("/delete", name:"delete")]
    public function delete(Request $request, EntityManagerInterface $em)
    {
        $nameToDelete = $request->request->get("nameToDelete");
        $animal = $this->AnimalRepository->findOneBy(['name'=>$nameToDelete]);
        if($animal !=  null)
        {
            $nbAnimal = 0;
            $animals = $this->AnimalRepository->findBy(["Race"=>$animal->getRaces()]);
            foreach($animals as $animal)
            {
                $nbAnimal += 1;
            }
                
            if($nbAnimal == 1)
            {
                $race = $this->RacesRepository->findOneBy(["label" => $animal->getRaces()->getLabel()]);
                $animal->setRace(null);
                $em->persist($animal);
                $em->remove($race);
                $em->flush();
            }
            if($animal->getLastRapport() != null)
            {
                $rapports = $this->RapportVeterinaireRepository->findBy(['id' => $animal->getLastRapport()->getId()]);
                if(isset($rapports))
                {
                    
                    foreach ($rapports as $rapport) {
                        $animal->setLastRapport(null);
                        $rapport->setAnimal(null);
                        $em->persist($rapport);
                        $em->remove($rapport);
                        $em->flush();
                    }
                }
            }
            (new MongoDB\Client(getenv('MONGODB_URI')))->arcadia->animal->deleteOne(["name"=>$nameToDelete]);
            $em->remove($animal);
            $em->flush();
    
            return new RedirectResponse(
                $this->router->generate('app_home')
            );
        }
        else{
            return $this->render("bundles/TwigBundle/Exception/NotFoundName.html.twig");
        }
        
    }
}
