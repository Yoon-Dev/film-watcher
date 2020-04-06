<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use App\Entity\Movie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;

class MovieController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    public function index(): Response
    {
        $number = random_int(0, 100);
        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $all = $repo->findAll();
        dump($all);
        return $this->render('pages/admin.all.html.twig', [
            'number' => $number,
        ]);
    }
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    public function createMovie(): Response
    {
        return $this->render('pages/admin.movie.create.html.twig', [

            ]);
    }
}