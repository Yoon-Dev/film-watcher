<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use App\Entity\Movie;
use App\Entity\Tag;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;


class ApiController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var ObjectManager
     */
    private $movierepo;
    /**
     * @var ObjectManager
     */
    private $tagrepo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->movierepo = $em->getRepository(Movie::class);
        $this->tagrepo = $em->getRepository(Tag::class);
    }

    public function index(): Response
    {
        // Return all the movies
        $encoder = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getName();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
        $serializer = new Serializer([$normalizer], [$encoder]);
        $all = $this->movierepo->findAll();

        dump($serializer->serialize($all, 'json'));
        // this return a clean json object
        return new Response($serializer->serialize($all, 'json'));
        // this return a json object with a lots of /
        // return $this->json($serializer->serialize($all, 'json'));
    }
}