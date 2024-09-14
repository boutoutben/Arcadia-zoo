<?php

namespace App\Controller;

use App\Entity\AllHabitats;
use App\Form\ChoiceModifType;
use App\Form\ModifAllHabitatsCreateType;
use App\Form\ModifAllHabitatsDeleteType;
use App\Form\ModifAllHabitatsUpdateType;
use App\Repository\AllHabitatsRepository;
use App\Repository\AnimalRepository;
use App\Repository\RapportVeterinaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;

#[Route('/modifAllHabitats', name: 'app_modif_all_habitats_')]
class ModifAllHabitatsController extends AbstractController
{
   
    private AllHabitatsRepository $AllHabitatsRepository;
    private AnimalRepository $AnimalRepository;
    private RapportVeterinaireRepository $RapportVeterinaireRepository;
    private RouterInterface $router;

    public function __construct(AllHabitatsRepository $AllHabitatsRepository, RouterInterface $router, AnimalRepository $AnimalRepository, RapportVeterinaireRepository $RapportVeterinaireRepository)
    {
        $this->AllHabitatsRepository = $AllHabitatsRepository;
        $this->AnimalRepository = $AnimalRepository;
        $this->RapportVeterinaireRepository = $RapportVeterinaireRepository;
        $this->router = $router;
    }

    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        
        $habitats = null;
        $choice = $_POST["choice"] ?? '';

        $formChoice = $this->createForm(ChoiceModifType::class, $habitats,[
            "method" => "post",
            "action" => $this->generateUrl("app_modif_all_habitats_index")
        ]);

        $form = $this->createForm(ModifAllHabitatsCreateType::class,$habitats,[
            "action" => $this->generateUrl('app_modif_all_habitats_create'),
            "method"=>"POST",
        ]);
        $formUpdate = $this->createForm(ModifAllHabitatsUpdateType:: class, $habitats,[
            "action" => $this->generateUrl('app_modif_all_habitats_update'),
            "method"=>"POST",
        ]);

        $formDelete = $this->createForm(ModifAllHabitatsDeleteType:: class, $habitats,[
            "action" => $this->generateUrl('app_modif_all_habitats_delete'),
            "method"=>"POST",
        ]);

        return $this->render('modif/index.html.twig', [
            "form" => $form,
            "choice" => $choice,
            "formUpdate" => $formUpdate,
            "formDelete" => $formDelete,
            "formChoice" => $formChoice,
            "title" => "modier les habitats",
            "actionName" => "/modifAllHabitats/index",
            "namePlace" => "habitat"
        ]);
    }


    #[Route('/create', name: 'create')]
    public function create(HttpFoundationRequest $request, EntityManagerInterface $em):Response
    {
        $habitats = new AllHabitats();
        $name = $request->request->get('name');
        $description = $request->request->get("description");
        $image = $request->files->get("image");
        $uploadDir = $this->getParameter('upload_directory');
        if ($image) {
            // Validate file type server-side
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $extension = strtolower($image->getClientOriginalExtension());

            if (!in_array($extension, $allowedExtensions)) {
                return $this->render('bundles/TwigBundle/Exception/FileError.html.twig');
            }
        }
            try {
                $image->move($uploadDir, $image->getClientOriginalName());
                // Success logic here
            } catch (FileException $e) {
                // Handle exception if something happens during file upload
                
            }

        if(isset($name)&& isset($description)&&isset($image)){
            $habitats->setName(htmlspecialchars($name));
            $habitats->setDescription($description);
            $habitats->setImg($image->getClientOriginalName());

            $em->persist($habitats);
            $em->flush();

            return new RedirectResponse(
                $this->router->generate('app_home')
            );
        }
    }

    #[Route('/update', name: 'update')]
    public function update(HttpFoundationRequest $request, EntityManagerInterface $em):Response
    {
        $habitats = new AllHabitats();
        $nameToChange = $request->request->get('nameToChange');
        $name = $request->request->get('name');
        $description = $request->request->get("description");
        $image = $request->files->get("image");
        $uploadDir = $this->getParameter('upload_directory');

        if(isset($nameToChange)){
            $habitats = $this->AllHabitatsRepository->findOneBy(['name' => $nameToChange]);

            if($habitats != null)
            {
                if($name != ""){
                    $habitats->setName(htmlspecialchars($name));
    
                }
                if($description != ""){
                    $habitats->setDescription($description);
                }
                if(isset($image)){
                    if ($image) {
                        // Validate file type server-side
                        $allowedExtensions = ['jpg', 'jpeg', 'png'];
                        $extension = strtolower($image->getClientOriginalExtension());
            
                        if (!in_array($extension, $allowedExtensions)) {
                            return $this->render('bundles/TwigBundle/Exception/FileError.html.twig');
                        }
                    }
                    try {
                        $image->move($uploadDir, $image->getClientOriginalName());
                        // Success logic here
                    } catch (FileException $e) {
                        // Handle exception if something happens during file upload
                    }
                    $habitats->setImg($image->getClientOriginalName());
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
    public function delete(HttpFoundationRequest $request, EntityManagerInterface $em)
    {
        $nameToDelete = $request->request->get("nameToDelete");
        $habitats = $this->AllHabitatsRepository->findOneBy(['name'=>$nameToDelete]);
        if($habitats != null)
        {
            $habitat = $this->AllHabitatsRepository->createQueryBuilder('a')
                ->where('a.id = :id')
                ->setParameter('id', $habitats->getId())
                ->getQuery()
                ->getOneOrNullResult();

            if (isset($habitat)){
                $animauxHabitat = $this->AnimalRepository->findBy(["Habitats"=>$habitat]);
                foreach($animauxHabitat as $animal)
                {
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
                    
                    $em->remove($animal);
                }
                $em->remove($habitat);
                $em->flush();
            }else{
                return $this->render("bundles/TwigBundle/Exception/NotFoundName.html.twig");
            }
            return new RedirectResponse(
                $this->router->generate('app_home')
            );
        }
        else{
            return $this->render("bundles/TwigBundle/Exception/NotFoundName.html.twig");
        }
        
    }
    

}
