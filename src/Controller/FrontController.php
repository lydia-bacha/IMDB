<?php

namespace App\Controller;

 
use App\Entity\Film;
use App\Entity\Realisateur;
use App\Repository\FilmRepository;
use App\Repository\RealisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    #[Route('/', name: 'front')]
    public function index(FilmRepository $filmRepo): Response
    {

      
        //$realisateur= $realisateurRepo->findAll();

        return $this->render('front/index.html.twig', [
            "films"=>$filmRepo->findAll()
           // "realisateur"=>$realisateur

        ]);
    }

    /**
     * @Route("/film/{id}", name="front_film")
     */
    public function film (Film $film){
        
        return $this->render("front/show-film.html.twig", [

            "film"=>$film,
               
        ]);
    }

    /**
     * @Route("/realisateur/{id}", name="front_realisateur")
     */
    public function realisateur(Realisateur $realisateur){
        return $this->render("front/show-realisateur.html.twig",[
            'realisateur' => $realisateur
            
        ]);
    }
}
