<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SerieController extends AbstractController
{

    #[Route('/serie', name: 'app_serie')]
    public function test(EntityManagerInterface $em): Response
    {
        $serie = new Serie();
        $serie->setName('One piece')
              ->setStatus('Returning')
              ->setGenre('Animé')
              ->setFirstAirDate(new \DateTime('1999-10-20'))
              ->setDateCreated(new \DateTime());

        $em->persist($serie);
        $em->flush();

        return new Response ('Ue série a été créée');
    }

    #[Route('/serie/list/{page}', name: 'list', requirements: ['page' => '\d+'], defaults: ['page' => 1], methods: ['GET'])]
    public function list(SerieRepository $seriesRepository, int $page, ParameterBagInterface $parameters): Response
    {

//        $series = $serieRepository->findAll();

        $nbParPage = $parameters->get('series')['nb_max'];
        $offset = ($page - 1) * $nbParPage;

        $criterias = [

            'genre' => 'Drama',
            'status' => 'Returning'
        ];
        $series = $seriesRepository->findBy(
            $criterias,
            [
                'popularity' => 'DESC'
            ],
            $nbParPage,
            $offset
        );
        $total = $seriesRepository->count($criterias);
        $totalPages = ceil($total / $nbParPage);

        return $this->render('serie/list.html.twig', [

                'series' => $series,
                'page' => $page,
                'totalPages' => $totalPages,
            ]
        );
    }


}
