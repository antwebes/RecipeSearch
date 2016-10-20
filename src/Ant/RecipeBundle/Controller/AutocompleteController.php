<?php
    namespace Ant\RecipeBundle\Controller;
     
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Ant\RecipeBundle\Entity\Ingredient;
    
     
    class AutocompleteController extends Controller
    {
       
        public function indexAction()
        {
            $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('RecipeBundle:Ingredient')
              ;
     
            $listIngredients = $repository->findBy(
                array(),                      // Critere
                array('id' => 'desc'),        // Tri
                null,                         // Limite
                null                          // Offset
              );
     
            
          return $this->render('RecipeBundle:Autocomplete:index.html.twig', array(
              'listIngredients' => $listIngredients,
          ));
          
        }
    }
