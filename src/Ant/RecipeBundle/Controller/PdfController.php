<?php

namespace Ant\RecipeBundle\Controller;
    
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;


    class PdfController extends Controller{
        
        /**
        * @Route("/recipe-pdf/{id}", name="show_recipe_pdf")
        */
        public function pdfAction ($id) {
            $em = $this->getDoctrine()->getManager();
            
            $recipe = $em->getRepository('RecipeBundle:Recipe')->findOneBy(array(
                'id' => $id
                ));
            
            $html = $this->render('sitio/recipeselected.html.twig', array(
                'recipe' => $recipe
                ));

            return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                200,
                array(
                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'attachment; filename="file.pdf"'
                )
            );
        }


    }
        


