<?php
// src/Controller/DefaultController.php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\User;
    use App\Entity\Video;
    use App\Entity\Address;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Cache\Adapter\FilesystemAdapter;

    class DefaultController extends AbstractController {

        /**
         * @Route("/home", name="default", name="home")
         */
        public function index(Request $request) {

            $cache = new FilesystemAdapter();
            $posts = $cache->getItem('database.get_posts');

            if (!$posts->isHit()) {
                $post_from_db = ['post 1', 'post 2', 'post 3'];

                dump('connected with database ...');

                $posts->set(serialize($post_from_db));
                $posts->expiresAfter(5);
                $cache->save($posts);
            }

            //$cache->deleteItem('database.get_posts');
            //$cache->clear();
            dump(unserialize($posts->get()));

            return $this->render('default/index.html.twig', [
                'controller_name' => 'DefaultController',
            ]);
        }

    }
