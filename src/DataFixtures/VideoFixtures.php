<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Video;


class VideoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        // utiliser faker est beaucoup plus smart
        $itab = [
        'acteur' => 'Jhonny depp',
        'film' => 'Pirate des caraibes',
        'description' => 'film sur des pirates alccolique',
        'tag' => 'action, aventure, blockbuster',
        'duree' => (int)180,
        'directeur' => 'Gore Verbinski',
        'production' => 'Disney'];

        $tab = [
            'acteur' => '',
            'film' => 'En avant',
            'description' => "Dans la banlieue d'un univers imaginaire, deux frères elfes se lancent dans une quête extraordinaire pour découvrir s'il reste encore un peu de magie dans le monde.",
            'tag' => 'Pixar, drole',
            'duree' => (int)120,
            'directeur' => 'Dan Scanlon',
            'production' => 'Disney, Pixar']; 
        for($i = 0; $i <100; $i++){
            $video = new Video();
            $injecttab = [];
            if($i%2 === 0){
                $injecttab = $tab;
            }else{
                $injecttab = $itab;
            }
            $video->setActeurs($injecttab['acteur'])
            ->setNom($injecttab['film'])
            ->setDescription($injecttab['description'])
            ->setType('film')
            ->setTag($injecttab['tag'])
            ->setDuree($injecttab['duree'])
            ->setDirecteur($injecttab['directeur'])
            ->setProducteur($injecttab['production']);

            $manager->persist($video);
            $manager->flush();
        }

    }
}
