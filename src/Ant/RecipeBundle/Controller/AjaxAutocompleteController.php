<?php

    namespace Ant\RecipeBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Ant\RecipeBundle\Entity\Ingredient;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 
    

    class AjaxAutocompleteController extends Controller
    {
        /**
        * @Route("/autocomplete/update/data", name="autocomplete")
        */
        public function updateDataAction(Request $request)
        {
            $data = $request->get('input');

            $em = $this->getDoctrine()->getManager();

            $query = $em->createQuery(''
                    . 'SELECT i.id, i.name '
                    . 'FROM RecipeBundle:Ingredient i ' 
                    . 'WHERE i.name LIKE :data '
                    . 'ORDER BY i.name ASC'
                    )
                    ->setParameter('data', '%' . $data . '%');
            $query->setMaxResults(10);
            $results = $query->getResult();

            $ingredientList = '<ul id="matchList">';
            foreach ($results as $result) {
                $matchStringBold = preg_replace('/('.$data.')/i', '<strong>$1</strong>', $result['name']); // Replace text field input by bold one
                $ingredientList .= '<li id="'.$result['name'].'">'.$matchStringBold.'</li>'; // Create the matching list - we put maching name in the ID too
            }
            $ingredientList .= '</ul>';

            $response = new JsonResponse();
            $response->setData(array('ingredientList' => $ingredientList));
            return $response;
        }
    }

