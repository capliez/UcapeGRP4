<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Langue;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Langue controller.
 *
 * @Route("langue")
 */
class LangueController extends Controller
{
    /**
     * Lists all langue entities.
     *
     * @Route("/", name="langue_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $langues = $em->getRepository('AppBundle:Langue')->findAll();

        return $this->render('langue/index.html.twig', array(
            'langues' => $langues,
        ));
    }

    /**
     * Creates a new langue entity.
     *
     * @Route("/new", name="langue_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $langue = new Langue();
        $form = $this->createForm('AppBundle\Form\LangueType', $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($langue);
            $em->flush();

            return $this->redirectToRoute('langue_show', array('id' => $langue->getId()));
        }

        return $this->render('langue/new.html.twig', array(
            'langue' => $langue,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a langue entity.
     *
     * @Route("/{id}", name="langue_show")
     * @Method("GET")
     */
    public function showAction(Langue $langue)
    {
        $deleteForm = $this->createDeleteForm($langue);

        return $this->render('langue/show.html.twig', array(
            'langue' => $langue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing langue entity.
     *
     * @Route("/{id}/edit", name="langue_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Langue $langue)
    {
        $deleteForm = $this->createDeleteForm($langue);
        $editForm = $this->createForm('AppBundle\Form\LangueType', $langue);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('langue_edit', array('id' => $langue->getId()));
        }

        return $this->render('langue/edit.html.twig', array(
            'langue' => $langue,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a langue entity.
     *
     * @Route("/{id}", name="langue_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Langue $langue)
    {
        $form = $this->createDeleteForm($langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($langue);
            $em->flush();
        }

        return $this->redirectToRoute('langue_index');
    }

    /**
     * Creates a form to delete a langue entity.
     *
     * @param Langue $langue The langue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Langue $langue)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('langue_delete', array('id' => $langue->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
