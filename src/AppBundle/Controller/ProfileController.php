<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\ProfileController as BaseController;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;



class ProfileController extends BaseController
{

    /**
     * Show the user.
     */
    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        if ($user->hasRole('ROLE_ELEVE')){
            $eleve = $this->getUser()->getEleve();

            return $this->render('@FOSUser/Profile/show.html.twig', array(
                'user' => $user,
                'submited' => !$eleve->getChoix()->isEmpty(),

            ));
        }


        return $this->render('@FOSUser/Profile/show.html.twig', array(
        'user' => $user,
        ));
    }

}
