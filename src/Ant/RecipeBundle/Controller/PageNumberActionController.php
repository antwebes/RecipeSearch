<?php

    namespace Ant\RecipeBundle\Controller;
    
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\JsonResponse;
    

    class PageNumberActionController extends Controller{
                
        /**
         * @Route("/search", name="search_recipe")
         */
        public function pageListAction(Request $request){
            
            $em    = $this->getDoctrine()->getManager();
            $dql   = "SELECT recipe FROM RecipeBundle:Recipe recipe";
            $query = $em->createQuery($dql);

            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query, 
                $request->query->getInt('page', 1),
                3
            );
    
            return $this->render('recipe.html.twig', array('recipes' => $pagination));
        }
    }
        
