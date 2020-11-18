<?php
// src/Controller/DefaultController.php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\User;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;


    class DefaultController extends AbstractController
    {

        /**
         * @Route("/home", name="home")
         */
        public function index(Request $request)
        {
            // $entityManager = $this->getDoctrine()->getManager();
            // $user = $entityManager->getRepository(User::class)->find(1);
            return $this->render('default/index.html.twig', [
                'controller_name' => 'DefaultController'
            ]);
        }

    }
