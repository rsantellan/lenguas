<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Trabajo;
use AppBundle\Entity\Category;

/**
 * Trabajo controller.
 *
 */
class TrabajoController extends Controller
{
    /**
     * Lists all trabajo entities.
     *
     */
    public function indexAction(Request $request, $slug)
    {
        $category = $this->get('lenguas.categories')->retrieveBySlug($slug);
        if (!$category) {
            throw $this->createNotFoundException('La categoria no existe');
        }
        return $this->render('trabajo/index.html.twig', array(
            'category' => $category,
            'trabajos' => $this->get('lenguas.trabajos')->retrieveAllOfCategory($category),
        ));
    }

    /**
     * Creates a new trabajo entity.
     *
     */
    public function newAction(Request $request, $slug)
    {
        $category = $this->get('lenguas.categories')->retrieveBySlug($slug);
        if (!$category) {
            throw $this->createNotFoundException('La categoria no existe');
        }
        $trabajo = new Trabajo();
        $trabajo->setCategory($category);
        $form = $this->retrieveForm($category, $trabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trabajo);
            $em->flush();

            return $this->redirectToRoute('admin_trabajos_edit', array('id' => $trabajo->getId()));
        }
        return $this->render('trabajo/new.html.twig', array(
            'category' => $category,
            'trabajo' => $trabajo,
            'form' => $form->createView(),
        ));
    }

    private function retrieveForm(Category $category, Trabajo $trabajo)
    {
        if($category->getType() == Category::PUBLICACION){
            return $this->createForm('AppBundle\Form\PublicacionType', $trabajo);
        }
        return $this->createForm('AppBundle\Form\MonografiaType', $trabajo);
    }

    /**
     * Displays a form to edit an existing trabajo entity.
     *
     */
    public function editAction(Request $request, Trabajo $trabajo)
    {
        $deleteForm = $this->createDeleteForm($trabajo);
        $editForm = $this->retrieveForm($trabajo->getCategory(), $trabajo);//$this->createForm('AppBundle\Form\TrabajoType', $trabajo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_trabajos_edit', array('id' => $trabajo->getId()));
        }

        return $this->render('trabajo/edit.html.twig', array(
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
        $slug = $trabajo->getCategory()->getSlug();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trabajo);
            $em->flush();
        }

        return $this->redirectToRoute('admin_trabajos_index', array('slug' => $slug));
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
            ->setAction($this->generateUrl('admin_trabajos_delete', array('id' => $trabajo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
