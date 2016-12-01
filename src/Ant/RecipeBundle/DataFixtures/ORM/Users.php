<?php

    namespace Ant\RecipeBundle\DataFixtures\ORM;
    
    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Ant\RecipeBundle\Entity\User;
    
    
    class Users extends AbstractFixture implements OrderedFixtureInterface{
        
        public function getOrder(){
            return 4;
        }
        
        public function load(ObjectManager $manager){
            $entidad = new User();
            $entidad->setUsername('theadmin');
            $entidad->setEmail('123@hotmail.com');
            $entidad->setPassword('$2y$13$q3umrr0dlz404cgw8c404edM6IsoLaRJ8CN7QjtxmezmKbUhDOUAG');
            $entidad->setSalt('q3umrr0dlz404cgw8c404sc8s48woow');
            
            $manager->persist($entidad);
            
            $manager->flush();
        }
    }


