<?php

    namespace Ant\RecipeBundle\Controller;
    
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use FOS\ElasticaBundle\Repository;

    

    class PageNumberActionController extends Controller{
                
        /**
         * @Route("/search", name="search_recipe")
         */
        public function pageListAction(Request $request){
            
            $finderRI = $this->container->get('fos_elastica.finder.app.RecipeIngredient');
            $finderIngredients = $this->container->get('fos_elastica.finder.app.Ingredient');

            $em = $this->getDoctrine()->getManager();   
                                           
            $array = array();
            
            $parameter = $request->get('q');
            $parameterq = explode(',', $parameter);
            
            
            $boolQuery = new \Elastica\Query\BoolQuery();
            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery->setFieldQuery('ingredient', $parameterq[0]);
            $fieldSecondQuery = new \Elastica\Query\Match();
            $fieldSecondQuery->setFieldQuery('ingredient', $parameterq[0]);
            $boolQuery->addMust($fieldQuery);
            $boolQuery->addMust($fieldSecondQuery); 
            
            $data = $finderRI->find($boolQuery);
            
            /*$boolQuery = new \Elastica\Query\BoolQuery();
            $recipeQuery = new \Elastica\Query\Match();
            $recipeQuery->setFieldQuery('fos_elastica.finder.app.RecipeIngredient', array($request));
            $recipeQuery->setFieldParam('fos_elastica.finder.app.Ingredient', 'analyzer', 'custom_analyzer');
            $boolQuery->addMust($recipeQuery);
            // nested query
            $query = new \Elastica\Query\Nested();
            $query->setPath('businessAddress');
            $query->setQuery($boolQuery);
            // pass the nested query to your finder
            $finderRI->find($query);*/
            
            
/* ////////////////////////////////////////////////////////////////////////////////////// */ 
            foreach($data as $ob){
                array_push($array, $ob->getRecipe()->getId());
            }
            
            
            $query = $em->getRepository('RecipeBundle:Recipe')->findRecipe(
                $array
            );            
   
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query, 
                $request->query->getInt('page', 1),
                3
            );
            
    
            return $this->render('recipe.html.twig', array('recipes' => $pagination));
        }
    }
        
