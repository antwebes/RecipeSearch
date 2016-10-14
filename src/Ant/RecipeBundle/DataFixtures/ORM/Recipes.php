<?php

    namespace Ant\RecipeBundle\DataFixtures\ORM;
    
    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Ant\RecipeBundle\Entity\Recipe;
    
    
    
    class Recipes extends AbstractFixture implements OrderedFixtureInterface{
        
        public function getOrder(){
            return 2;
        }
        
        public function load(ObjectManager $manager){
            $recipes = array(
                array('id' => '1', 'name' => 'Pasta con pollo', 'description' => 'Pasta cocida con pollo a la plancha', 'elaboration' =>'Calentar agua echar pasta y asar pollo', 'time' => 600, 'category' => 'almuerzo', 'slug' => 'pasta-con-pollo', 'path_video' => 'recetacocina1', 'diners' => '2'),
                array('id' => '2', 'name' => 'Arroz con pollo', 'description' => 'Arroz cocida con pollo a la plancha', 'elaboration' =>'Calentar agua echar arroz y asar pollo', 'time' => 1200, 'category' => 'almuerzo', 'slug' => 'arroz-con-pollo', 'path_video' => 'recetacocina2', 'diners' => '2'),
                array('id' => '3', 'name' => 'Ensalada con pollo', 'description' => 'Ensalada con taquitos de pollo', 'elaboration' =>'Añadir pollo a tu ensalada', 'time' => 200, 'category' => 'cena', 'slug' => 'ensalada-de-pollo', 'path_video' => 'recetacocina3', 'diners' => '1')
            );
            
            foreach ($recipes as $recipe) {
                $entidad = new Recipe();
                $entidad->setName($recipe['name']);
                $entidad->setDescription($recipe['description']);
                $entidad->setElaboration($recipe['elaboration']);
                $entidad->setTime($recipe['time']);
                $entidad->setCategory($recipe['category']);
                $entidad->setPathVideo($recipe['path_video']);
                $entidad->setSlug($recipe['slug']);
                $entidad->setDiners($recipe['diners']);

                
                $manager->persist($entidad);
            }
            $manager->flush();
        }
    }

