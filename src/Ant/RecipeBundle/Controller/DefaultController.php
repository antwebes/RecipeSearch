<?php

    namespace Ant\RecipeBundle\Controller;
    
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
   


    class DefaultController extends Controller{

        /**
        * @Route(
        * "/sitio/{nombrePagina}/",
        * defaults={ "nombrePagina" = "ayuda" },
        * requirements={ "nombrePagina" = "ayuda|sobre_nosotros" },
        * name="pagina"
        * )
        */
        public function pageAction($nombrePagina = 'ayuda'){
            $em = $this->getDoctrine()->getManager();
            

            return $this->render('sitio/'.$nombrePagina.'.html.twig');
        }


        
        /**
         * @Route("/search", name="search_recipe")
         * 
         */
        public function searcherAction(){
            $em = $this->getDoctrine()->getManager();
            $recipes = $em->getRepository('RecipeBundle:Recipe')->findAll();
            
            return $this->render('recipe.html.twig', array(
                'recipes' => $recipes
            ));
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
        * @Route("/", name="portada")
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
}
