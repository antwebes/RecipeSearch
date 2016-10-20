<?php

    namespace Ant\RecipeBundle\Controller;
    
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;


    class DefaultController extends Controller{

        /**
        * @Route(
        * "/sitio/{nombrePagina}/",
        * defaults={ "nombrePagina" = "ayuda" },
        * requirements={ "nombrePagina" = "ayuda|recipe|sobre_nosotros|recipeselected" },
        * name="pagina"
        * )
        */
        public function pageAction($nombrePagina = 'ayuda'){
            $em = $this->getDoctrine()->getManager();

            return $this->render('sitio/'.$nombrePagina.'.html.twig');
        }


        /**
        * @Route("/portada", name="portada")
        */
        public function coverAction(){
            $em = $this->getDoctrine()->getManager();
            $recipe = $em->getRepository('RecipeBundle:Recipe')->findOneBy(array(
                'id' => 1
                ));
            
            return $this->render('portada.html.twig', array(
                'recipe' => $recipe
                ));
        }
}
