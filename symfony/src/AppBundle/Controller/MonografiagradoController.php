<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Trabajo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Monografiagrado controller.
 *
 */
class MonografiagradoController extends Controller
{
    /**
     * Lists all trabajo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $trabajos = $this->get('lenguas.trabajos')->retrieveAllMonografiasGrado();
        return $this->render('monografiagrado/index.html.twig', array(
            'trabajos' => $trabajos,
        ));
    }

    /**
     * Creates a new trabajo entity.
     *
     */
    public function newAction(Request $request)
    {
        $trabajo = new Trabajo();
        $trabajo->setType(Trabajo::MONOGRAFIAGRADO);
        $form = $this->createForm('AppBundle\Form\MonografiaType', $trabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trabajo);
            $em->flush();

            return $this->redirectToRoute('admin_monografiagrado_edit', array('id' => $trabajo->getId()));
        }

        return $this->render('monografiagrado/new.html.twig', array(
            'trabajo' => $trabajo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a trabajo entity.
     *
     */
    public function showAction(Trabajo $trabajo)
    {
        $deleteForm = $this->createDeleteForm($trabajo);

        return $this->render('monografiagrado/show.html.twig', array(
            'trabajo' => $trabajo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing trabajo entity.
     *
     */
    public function editAction(Request $request, Trabajo $trabajo)
    {
        $deleteForm = $this->createDeleteForm($trabajo);
        $editForm = $this->createForm('AppBundle\Form\MonografiaType', $trabajo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_monografiagrado_edit', array('id' => $trabajo->getId()));
        }

        return $this->render('monografiagrado/edit.html.twig', array(
            'trabajo' => $trabajo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a trabajo entity.
     *
     */
    public function deleteAction(Request $request, Trabajo $trabajo)
    {
        $form = $this->createDeleteForm($trabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trabajo);
            $em->flush();
        }

        return $this->redirectToRoute('admin_monografiagrado_index');
    }

    /**
     * Creates a form to delete a trabajo entity.
     *
     * @param Trabajo $trabajo The trabajo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Trabajo $trabajo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_monografiagrado_delete', array('id' => $trabajo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
