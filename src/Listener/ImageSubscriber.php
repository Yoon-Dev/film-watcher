<?php

namespace App\Listener;

use App\Entity\Movie;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Symfony\Component\Filesystem\Filesystem;

class ImageSubscriber implements EventSubscriber {

    /**
     * @var UploaderHelper
     */
    private $uploaderHelper;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    public function __construct(UploaderHelper $uploaderHelper, Filesystem $filesystem)
    {
        $this->uploaderHelper = $uploaderHelper;
        $this->fileSystem = $filesystem;
    }
   
    public function getSubscribedEvents()
    {
        return [
            'preRemove'
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
        {

            $entity = $args->getEntity();
            if(!$entity instanceof Movie){
                return;
            }
            $this->fileSystem->remove(getcwd().$this->uploaderHelper->asset($entity, 'imageFile'));

        }

}