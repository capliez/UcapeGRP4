<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Eleve;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

               if($this->isGranted("IS_AUTHENTICATED_REMEMBERED") == null ){
                   return $this->redirectToRoute('fos_user_security_login');
               }

        return $this->render('default/index.html.twig');

    }

    /**
     * @Route("/articles/add", name="add_showarticle")
     */
    public function AddAction(Request $request)
    {

        
       return $this->redirectToRoute('homepage');

    }


    /**
     * @Route("/choixetablissement", name="choixetablissement")
     */
    public function choixetablissementAction(Request $request)
    {


        return $this->render('default/choixEtablissement.html.twig');

    }

    /**
     * @Route("/documentations", name="documentations")
     */
    public function documentationsAction(Request $request)
    {


        return $this->render('default/documentations.html.twig');

    }



}
