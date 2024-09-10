<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\CreateAvisType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Global_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;


#[Route('/avis', name: 'app_avis_')]
class AvisController extends AbstractController
{
    private RouterInterface $router;
    private AvisRepository $avisRepository;

    public function __construct(RouterInterface $router, AvisRepository $avisRepository)
    {
        $this->router = $router;
        $this->avisRepository = $avisRepository;
    }

    #[Route('/index', name: 'index')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $Avis = new Avis();
        $form = $this->createForm(CreateAvisType::class,$Avis,[
            "method" => "POST",
            "action" => $this->generateUrl("app_avis_index"),
        ]);
        $form->handleRequest($request);
        $pseudo = $request->request->get("pseudo");
        $avis = $request->request->get("avis");
        $Avis->setPseudo(htmlspecialchars($pseudo));
        $Avis->setAvis(htmlspecialchars($avis));
        $Avis->setValid(false);

         // Check if the form is submitted and valid
        if ($form->isSubmitted()) {
            // Set additional properties if needed (not required here since the form handles it)
            //dd($form->getErrors(true));
            if($form->isValid())
            {
                // Persist the entity to the database
                $em->persist($Avis);
                $em->flush();
                // Redirect to the home page or any other page
                return $this->redirectToRoute('app_home');
            }
        }     
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
            "form" => $form->createView(),
        ]);
    }


    #[Route("/yes/{id}", name:"yes")]
    public function yes($id, EntityManagerInterface $em):Response
    {
        $avis = $this->avisRepository->findOneBy(['id' => $id]);
        $avis->setValid(true);

        $em->flush();

        return new RedirectResponse(
            $this->router->generate("app_employee")
        );
    }

    #[Route("/no/{id}", name: "no")]
    public function no($id, EntityManagerInterface $em): Response
    {
        $avis = $this->avisRepository->findOneBy(["id" => $id]);
        $em->remove($avis); 
        $em->flush();

        return new RedirectResponse(
            $this->router->generate("app_employee")
        );
    }
}
