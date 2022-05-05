<?php

namespace App\Controller;


use App\Entity\Entreprise;
use App\Entity\Pfe;

use App\Form\PfeType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PfeController extends AbstractController
{ #[Route('/pfe/add/{id?0}', name: 'pfe_add')]
public function addPfe(ManagerRegistry $doctrine,Request $request,Pfe $pfe=null): Response
{
    if(!$pfe){
        $pfe=new Pfe();
    }
    $entitymanager=$doctrine->getManager();
    $form=$this->createForm(PfeType::class,$pfe);
    $form->handleRequest($request);
    if($form->isSubmitted()){
        $entitymanager->persist($pfe);
        $entitymanager->flush();
        $this->addFlash('alert','Pfe added successfuly');
        return $this->redirectToRoute('pfe_list');
    }
    else{
        $this->addFlash('erreur',"form n'est pas rempli");
        return $this->render('pfe/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}

    #[Route('/pfe/all', name: 'pfe_list')]
    public function index(ManagerRegistry $doctrine):Response{
        $repository=$doctrine->getRepository(Pfe::class);
        $pfes=$repository->findAll();
        return $this->render('pfe/list.html.twig',['pfes'=>$pfes]);
    }
    #[Route('/pfe/listeentre', name: 'pfe_listes')]
    public function showStats(ManagerRegistry $doctrine):Response{
        $repository=$doctrine->getRepository()(Entreprise::class);
        $entre=$repository->findAll();
        return $this->render('pfe/liste2.html.twig',['entre'=>$entre]);
    }




}
