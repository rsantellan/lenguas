<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Documento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Documento controller.
 *
 */
class DocumentoController extends Controller
{
    /**
     * Lists all documento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documentos = $em->getRepository('AppBundle:Documento')->findAll();

        return $this->render('documento/index.html.twig', array(
            'documentos' => $documentos,
        ));
    }

    /**
     * Creates a new documento entity.
     *
     */
    public function newAction(Request $request)
    {
        $documento = new Documento();
        $form = $this->createForm('AppBundle\Form\DocumentoType', $documento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($documento);
            $em->flush();

            return $this->redirectToRoute('admin_documentos_edit', array('id' => $documento->getId()));
        }

        return $this->render('documento/new.html.twig', array(
            'documento' => $documento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing documento entity.
     *
     */
    public function editAction(Request $request, Documento $documento)
    {
        $deleteForm = $this->createDeleteForm($documento);
        $editForm = $this->createForm('AppBundle\Form\DocumentoType', $documento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_documentos_edit', array('id' => $documento->getId()));
        }

        return $this->render('documento/edit.html.twig', array(
            'documento' => $documento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a documento entity.
     *
     */
    public function deleteAction(Request $request, Documento $documento)
    {
        $form = $this->createDeleteForm($documento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($documento);
            $em->flush();
        }

        return $this->redirectToRoute('admin_documentos_index');
    }

    /**
     * Creates a form to delete a documento entity.
     *
     * @param Documento $documento The documento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Documento $documento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_documentos_delete', array('id' => $documento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
