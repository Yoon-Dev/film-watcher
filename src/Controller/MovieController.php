<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use App\Entity\Movie;
use App\Form\MovieType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var ObjectManager
     */
    private $movierepo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->movierepo = $em->getRepository(Movie::class);

    }

    public function index(): Response
    {
        $all = $this->movierepo->findAll();
        dump($all);
        return $this->render('pages/admin.all.html.twig', [
            'movies' => $all
        ]);
    }
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    public function createMovie(Request $request): Response
    {
        $newmovie = new Movie();
        $form = $this->createForm(MovieType::class, $newmovie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($newmovie);
            $this->em->flush();
            return $this->redirectToRoute('admin.all');
        }
        return $this->render('pages/admin.movie.create.html.twig', [
                'form' => $form->createView(),
            ]);
    }
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    public function editMovie(Movie $movie, Request $request): Response
    {
        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin.all');
        }
         return $this->render('pages/admin.movie.edit.html.twig', [
                'form' => $form->createView(),
            ]);
    }
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    public function deleteMovie(Movie $movie, Request $request): Response
    {
        $this->em->remove($movie);
        $this->em->flush();
        return $this->redirectToRoute('admin.all');
    }
}