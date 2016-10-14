<?php

    namespace Ant\RecipeBundle\DataFixtures\ORM;
    
    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Ant\RecipeBundle\Entity\RecipeIngredient;
    
    
    class RecipeIngredients extends AbstractFixture implements OrderedFixtureInterface{
        
        public function getOrder(){
            return 3;
        }
        
        public function load(ObjectManager $manager){
            $ingredients = $manager->getRepository('RecipeBundle:Ingredient')->findAll();
            $recipes = $manager->getRepository('RecipeBundle:Recipe')->findAll();
            foreach ($recipes as $recipe) {
                $entidad = new RecipeIngredient();
                $entidad->setMandatory(true);
                $entidad->setQuantity(1000);
                
                $ingredient = $ingredients[0];
                $entidad->setIngredient($ingredient);
                
                $entidad->setRecipe($recipe);
                
                $manager->persist($entidad);
            }    
            
            $manager->flush();
        }
    }

