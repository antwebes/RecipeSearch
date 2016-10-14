<?php

    namespace Ant\RecipeBundle\DataFixtures\ORM;
    
    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Ant\RecipeBundle\Entity\Ingredient;
    
    
    class Ingredients extends AbstractFixture implements OrderedFixtureInterface{
        
        public function getOrder(){
            return 1;
        }
        
        public function load(ObjectManager $manager){
            for ($i = 0; $i < 400; $i++) {
                $entidad = new Ingredient();
                $entidad->setName('name'.$i);
                $entidad->setCreatedAt(new \DateTime());                
                $manager->persist($entidad);
            }
            $manager->flush();
        }
    }

