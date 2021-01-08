<?php
// src/Controller/DefaultController.php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Cache\Adapter\TagAwareAdapter;
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

            $cache = new TagAwareAdapter(
                new FilesystemAdapter()
            );

            $acer = $cache->getItem('acer');
            $dell = $cache->getItem('dell');
            $apple = $cache->getItem('apple');
            $ibm = $cache->getItem('ibm');

            if(!$acer->isHit()){
                $acer_from_db = 'acer laptop';
                $acer->set($acer_from_db);
                $acer->tag(['computers','laptops','acer']);
                $cache->save($acer);
                dump('acer laptop from database...');
            }


            if(!$dell->isHit()){
                $dell_from_db = 'dell laptop';
                $dell->set($dell_from_db);
                $dell->tag(['computers','laptops','dell']);
                $cache->save($dell);
                dump('dell laptop from database...');
            }


            if(!$apple->isHit()){
                $apple_from_db = 'apple laptop';
                $apple->set($apple_from_db);
                $apple->tag(['computers','desktops','apple']);
                $cache->save($apple);
                dump('apple laptop from database...');
            }


            if(!$ibm->isHit()){
                $ibm_from_db = 'ibm laptop';
                $ibm->set($ibm_from_db);
                $ibm->tag(['computers','desktops','ibm']);
                $cache->save($acer);
                dump('ibm laptop from database...');
            }

            $cache->invalidateTags(['ibm']);
            $cache->invalidateTags(['laptops']);


            dump($acer->get());
            dump($dell->get());
            dump($apple->get());
            dump($ibm->get());

        /*    $posts = $cache->getItem('database.get_posts');

            if (!$posts->isHit()) {
                $post_from_db = ['post 1', 'post 2', 'post 3'];

                dump('connected with database ...');

                $posts->set(serialize($post_from_db));
                $posts->expiresAfter(5);
                $cache->save($posts);
            }*/

            //$cache->deleteItem('database.get_posts');
            //$cache->clear();
            //dump(unserialize($posts->get()));

            return $this->render('default/index.html.twig', [
                'controller_name' => 'DefaultController',
            ]);
        }

        /**
         * http://test.com/symfony-course/staff/employees?deleted=123
         *
         * @author dsherlock
         * @param Request $request
         * @return Response
         * @Route("/{section?}/{page?}",name="test")
         */
        public function index2(Request  $request)
        {

            $routeParams = $request->attributes->get('_route_params');
            $section = $routeParams['section'];
            $page = $routeParams['page'];

            $deleted = $request->query->get('deleted');


            dump($section); //staff
            dump($page); //employees
            dump($deleted); //employees


            return new Response('Optional parameters in url and requirements for parameters');
        }

        /**
         * @Route(
         *      "/articles/{_locale}/{year}/{slug}/{category}",
         *      defaults={"category": "computers"},
         *      requirements={
         *         "_locale": "en|fr",
         *          "category": "computers|rtv",
         *          "year": "\d+"
         *      }
         * )
         */
        public function index3()
        {
            return new Response('An advanced route example');
        }

        /**
         * @Route({
         *      "nl": "/over-ons",
         *       "en": "/about-us"
         * }, name="about_us")
         */
        public function index4()
        {
            return new Response('Translated routes');
        }
    }
