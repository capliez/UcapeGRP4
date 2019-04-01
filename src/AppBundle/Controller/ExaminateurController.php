<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Examinateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Examinateur controller.
 *
 * @Route("examinateur")
 */
class ExaminateurController extends Controller
{
    /**
     * Lists all examinateur entities.
     *
     * @Route("/", name="examinateur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $examinateurs = $em->getRepository('AppBundle:Examinateur')->findAll();

        return $this->render('examinateur/index.html.twig', array(
            'examinateurs' => $examinateurs,
        ));
    }

    /**
     * Creates a new examinateur entity.
     *
     * @Route("/new", name="examinateur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $examinateur = new Examinateur();
        $form = $this->createForm('AppBundle\Form\ExaminateurType', $examinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($examinateur);
            $em->flush();

            return $this->redirectToRoute('examinateur_show', array('id' => $examinateur->getId()));
        }

        return $this->render('examinateur/new.html.twig', array(
            'examinateur' => $examinateur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a examinateur entity.
     *
     * @Route("/{id}", name="examinateur_show")
     * @Method("GET")
     */
    public function showAction(Examinateur $examinateur)
    {
        $deleteForm = $this->createDeleteForm($examinateur);

        return $this->render('examinateur/show.html.twig', array(
            'examinateur' => $examinateur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing examinateur entity.
     *
     * @Route("/{id}/edit", name="examinateur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Examinateur $examinateur)
    {
        $deleteForm = $this->createDeleteForm($examinateur);
        $editForm = $this->createForm('AppBundle\Form\ExaminateurType', $examinateur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('examinateur_edit', array('id' => $examinateur->getId()));
        }

        return $this->render('examinateur/edit.html.twig', array(
            'examinateur' => $examinateur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a examinateur entity.
     *
     * @Route("/{id}", name="examinateur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Examinateur $examinateur)
    {
        $form = $this->createDeleteForm($examinateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($examinateur);
            $em->flush();
        }

        return $this->redirectToRoute('examinateur_index');
    }

    /**
     * Creates a form to delete a examinateur entity.
     *
     * @param Examinateur $examinateur The examinateur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Examinateur $examinateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('examinateur_delete', array('id' => $examinateur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
