<?php
// src/Controller/DefaultController.php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\User;
    use App\Entity\Video;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;


    class DefaultController extends AbstractController
    {

        /**
         * @Route("/home", name="default", name="home")
         */
        public function index(Request $request)
        {
            $entityManager = $this->getDoctrine()->getManager();

            // $user = new User();
            // $user->setName('Robert');

            // for($i=1; $i<=3; $i++)
            // {
            //     $video = new Video();
            //     $video->setTitle('Video title -'. $i);
            //     $user->addVideo($video);
            //     $entityManager->persist($video);
            // }

            // $entityManager->persist($user);
            // $entityManager->flush();

            // dump('Created a video with the id of '. $video->getId());
            // dump('Created a user with the id of '. $user->getId());

            // $video = $this->getDoctrine()
            // ->getRepository(Video::class)
            // ->find(1);

            // dump($video->getUser());
            // dump($video->getUser()->getName());

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->find(1);

            foreach($user->getVideos() as $video)
            {
                dump($video->getTitle());
            }

            return $this->render('default/index.html.twig', [
                'controller_name' => 'DefaultController'
            ]);
        }

    }
