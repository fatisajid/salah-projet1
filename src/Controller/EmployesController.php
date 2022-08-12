<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Form\EmployerType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployesController extends AbstractController
{
    #[Route('/', name: 'app_employes')]
    public function index(EmployesRepository $repo): Response
    {
        $employes = $repo->findAll();
        return $this->render('employes/index.html.twig', [
            'tabEmployes' => $employes,
        ]);
    }


#[Route("/new", name: "new_employes")]
#[Route("/edit/{id}", name :"edit")]


public function form(Request $superglobals,EntityManagerInterface $manager, Employes $employes = null)
{
   if($employes == null)
   {
    $employes = new Employes;
    
   }
   $form = $this->createForm(EmployerType::class, $employes);
   $form->handleRequest($superglobals);

   if($form->isSubmitted() && $form->isValid())
   {
    $manager->persist($employes);
    $manager->flush();
    return $this->redirectToRoute('app_employes',['id'=>$employes->getId() ]);

   }


   return $this->renderForm("employes/form.html.twig",[
    'formEmployes' => $form,
    'editMode'=> $employes->getId() !== null
   ]);

}

#[Route("/delete/{id}", name:"delete")]
public function delete(EntityManagerInterface $manager, $id, EmployesRepository $repo)
     {
        $employes = $repo->find($id);

        $manager->remove($employes);
        

        $manager ->flush();
        

        $this->addFlash('success',"l'employer a bien été supprimé !");

        
        return $this->redirectToRoute("app_employes");
       

     }

}