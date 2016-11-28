<?php

    namespace Ant\RecipeBundle\Controller;
    
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;


    class DefaultController extends Controller{

        /**
        * @Route(
        * "/sitio/{nombrePagina}/",
        * defaults={ "nombrePagina" = "ayuda" },
        * requirements={ "nombrePagina" = "postres|sobre_nosotros" },
        * name="pagina"
        * )
        */
        public function pageAction($nombrePagina = 'ayuda'){
            $em = $this->getDoctrine()->getManager();                                               
            
            return $this->render('sitio/'.$nombrePagina.'.html.twig');
        }

        
         /**
         * @Route("/recipe", name="list_recipe")
         * 
         */
        public function listControllerAction(Request $request){
            $em    = $this->get('doctrine.orm.entity_manager');
            $dql   = "SELECT a FROM RecipeBundle:Recipe a";
            $query = $em->createQuery($dql);

            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                3/*limit per page*/
            );

            return $this->render('recipe.html.twig', array('recipes' => $pagination));
        }
        

        /**
        * @Route("/recipe/{id}", name="show_recipe")
        */
        public function coverAction($id){
            $em = $this->getDoctrine()->getManager();
            $recipe = $em->getRepository('RecipeBundle:Recipe')->findOneBy(array(
                'id' => $id
                ));
            
            
            if($recipe==null){
                throw $this->createNotFoundException("La receta que buscas no se encuentra en nuestro repositorio, por favor cambia el id de la misma y vuelve a intentarlo");
            }else{
            return $this->render('sitio/recipeselected.html.twig', array(
                'recipe' => $recipe
                ));
            }
        }
        
        /**
        * @Route("/",
        * name="portada")
        */
        public function portadaAction(){
            $em = $this->getDoctrine()->getManager();
            $recipe = $em->getRepository('RecipeBundle:Recipe')->findOneBy(array(
                'id' => 1
                ));
            
            return $this->render('portada.html.twig', array(
                'recipe' => $recipe
                ));
        }
        
        public function counterAction(){
            $em = $this->getDoctrine()->getManager();
            $recipes = $em->getRepository('RecipeBundle:Recipe')->findAll();
            $count = count($recipes);
            $ingredients = $em->getRepository('RecipeBundle:Ingredient')->findAll();
            $countIngredients = count($ingredients);
            return $this->render('default/counters.html.twig', array(
                'countsrecipe' => $count, 'countingredients' => $countIngredients
            ));
        }
}
