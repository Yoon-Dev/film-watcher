<?php
namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use App\Entity\VideoSearch;
use App\Form\VideoSearchType;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Utils\Contains;
use PhpParser\Builder\Property;

class FilmsController extends AbstractController{
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // attribut
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
    /**
     * @var VideoRepository
     */
    private $videorepository;
    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var Contains
     */
    private $utils;

    /**
     * @var VideoSearch
     */
    private $search;
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    // CONSTRUCT
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    public function __construct(VideoRepository $repo, ObjectManager $em)
    {
        $this->utils = new Contains();
        $this->search = new VideoSearch();
        $this->em = $em;
        $this->videorepository = $repo;
    }  
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // fonctionnalité
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function index(Request $request): Response
    {

        
        $form = $this->createForm(VideoSearchType::class, $this->search);
        $form->handleRequest($request);

        $tags = [];
        // Creer un entité qui va représenté la recherche
        // Créer un formulaire
        // Gérér le traitement dans le formulaire
        // $films = $this->videorepository->findBy(['type' => "film", "nom" => "Pirate des caraibes"]);
        $films = $this->videorepository->findByQuery($this->search);
        foreach ($films as $k => $v) {

            $tmp_tag = explode(",", $v->getTag());
            foreach ($tmp_tag as $k => $v) {
                if($this->utils->contains($v,$tags)){
                    array_push($tags, $v);
                }
            }

        }
        return $this->render('pages/films.twig', [
            'tags' => $tags,
            'current_view' => 'films',
            'films' => $films,
            'form' => $form->createView()
        ]);
    }
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°  
    public function single(int $id, string $slug, Request $request): Response
    {

        $film = $this->videorepository->findOneBy(['id' => $id]);
        // change le nom de l'url si mauvais slug
        if($film->slug() !== $slug){
            return $this->redirectToRoute("singlefilm",[
                "slug" => $film->slug(),
                "id" => $id
            ], 301);
        }
        // crée le formulaire
        $form = $this->createForm(VideoType::class, $film);
        $form->remove('serie_id');
        $form->remove('soustitre_id');
        $form->add('type', ChoiceType::class, [
            'choices'  => [
                'film' => 'film',
                'serie' => 'serie'
            ],
        ]);
        // gère la bdd
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('films');
        }
        // envoie la vue
        return $this->render('pages/singlefilm.twig', [
            'current_view' => 'films',
            'film' => $film,
            'form' =>$form->createView()
        ]);

    }
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°° 
    public function add(Request $request): Response
    {
    // add a new film
    // create the add form
    $film = new Video();
    $film->setType('film');
    $form = $this->createForm(VideoType::class, $film);
    $form->remove('serie_id');
    $form->remove('soustitre_id');
    // manage database 
    $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($film);
            $this->em->flush();
            $this->addFlash('success', 'Film enregistré !');
            return $this->redirectToRoute('films');
        }
    // send the add view
    return $this->render('pages/addfilm.twig', [
        'current_view' => 'films',
        'form' =>$form->createView()
    ]);

    }
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
// °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°° 
    public function delete(int $id, Request $request): RedirectResponse
    {
    // remove a film element 
    if($this->isCsrfTokenValid('delete', $request->request->get('_token'))){
        $film = $this->videorepository->findOneBy(['id' => $id]);
        $this->em->remove($film);
        $this->em->flush();
        $this->addFlash('success', 'Film supprimé avec succes');

    }
    return $this->redirectToRoute('films');
    }

}