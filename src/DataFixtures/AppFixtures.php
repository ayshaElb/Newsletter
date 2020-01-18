<?php

namespace App\DataFixtures;


use App\Entity\Subscriber;
use App\Entity\TypeNewsletter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // création des Type newsletters
        $types = array ('Produits', 'Publications', 'Services');
        $type = [];
                
            for ($t=0; $t < 1 ; $t++) {                 
                    foreach ($types as $key => $value) {
                        $type[$t] = new TypeNewsletter();
                        $type[$t]->setName($value);
                        $manager->persist($type[$t]); 
                    }                
            }
        
           

        // création d'un subcriber
                
        for ($i=0; $i < 4 ; $i++) { 
            $subscriber[$i] = new Subscriber();
            $subscriber[$i]->setFirstname('prénom')
            ->setEmail('test@test.com');
            
                $randomTypes = (array) array_rand($type, rand(1, count($type)));
                foreach ($randomTypes as $key => $value) {
                    $subscriber[$i]->addType($type[$key]);
                }
                $manager->persist($subscriber[$i]);
            }        

        $manager->flush();
    }
}
