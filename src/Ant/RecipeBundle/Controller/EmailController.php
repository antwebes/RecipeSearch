<?php


    namespace Ant\RecipeBundle\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\JsonResponse;


    class EmailController extends Controller{

        /**
        * @Route("/email", name="sendmail")
        */
       public function emailSendAction(Request $request){
           
           if($request->isMethod('GET')){
                $message = \Swift_Message::newInstance()
                        ->setSubject('Hello email')
                        ->setFrom(('searcherrecipe@gmail.com'))
                        ->setTo($request->get('email'))
                        ->setBody('Gracias por solicitar nuestro boletín de noticias');
           }

            $this->get('mailer')->send($message);

            return $this->render('/sitio/sobre_nosotros.html.twig');
        }
    }

