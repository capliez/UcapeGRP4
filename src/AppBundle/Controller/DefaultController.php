<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Eleve;
use AppBundle\Entity\Pays;
use AppBundle\Form\ChoixEtaType;
use AppBundle\Entity\Etablissement;
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


    /*    if($this->isGranted("IS_AUTHENTICATED_REMEMBERED") == null ){

                   return $this->redirectToRoute('fos_user_security_login');

        }*/

        if($this->isGranted("IS_AUTHENTICATED_REMEMBERED") ){
            $user= $this->getUser();

            if ($user->hasRole('ROLE_ELEVE')){
            $eleve = $this->getUser()->getEleve();
            return $this->render('default/index.html.twig', [
                'submited' => !$eleve->getChoix()->isEmpty(),
            ]);
        }}

        return $this->render('default/index.html.twig');

    }





}
