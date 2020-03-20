<?php
namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class FilmsController extends AbstractController{
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // attribut
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
    /**
     * @var VideoRepository
     */
    private $videorepository;
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    // CONSTRUCT
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    public function __construct(VideoRepository $repo)
    {
        $this->videorepository = $repo;
    }  
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // fonctionnalité
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function index(): Response
    {

        $films = $this->videorepository->findBy(['type' => "film"]);
        // $film = new Video();
        // $film->setNom('Serie')
        //     ->setDescription('Description')
        //     ->setType('serie')
        //     ->setTag('test')
        //     ->setDuree(120)
        //     ->setProducteur('Warner Bros')
        //     ->setActeurs(('Leonardo Didi'))
        //     ->setDirecteur('Directeur Directeur');
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($film);
        // $em->flush();

        return $this->render('pages/films.twig', [
            'current_view' => 'films',
            'films' => $films
        ]);
    }
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°  
    public function single(int $id, string $slug): Response
    {

        $film = $this->videorepository->findOneBy(['id' => $id]);
        if($film->slug() !== $slug){
            return $this->redirectToRoute("singlefilm",[
                "slug" => $film->slug(),
                "id" => $id
            ], 301);
        }
        dump($film);

        return $this->render('pages/singlefilm.twig', [
            'current_view' => 'films',
            'film' => $film
        ]);
    }

}