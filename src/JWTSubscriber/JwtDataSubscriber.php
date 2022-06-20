<?php

namespace App\JWTSubscriber;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class JwtDataSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            Events::JWT_CREATED => "addInfo"
        ];
    }

    public function addInfo(JWTCreatedEvent $event)
    {
        $user = $event->getUser();
        /** 
         * @var User $user
         */
        $data = $event->getData();

        $data['id'] = $user->getId();
        $data["firstName"] = $user->getFirstName();
        $data["lastName"] = $user ->getLastName();
        
        
        
        
        $event->setData($data);
    }
}