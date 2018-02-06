<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $dql = 'Select u, r from AppBundle:User u left join u.user_roles r';
        $users = $em->createQuery($dql)->getResult();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newUser = $this->get('fos_user.user_manager')->createUser();
            $newUser->setUsername($user->getEmail());
            $newUser->setEmail($user->getEmail());
            $newUser->setPlainPassword('historialinguistica');
            $newUser->setEnabled(true);
            $newUser->setRoles($user->getRoles());
            $token = sha1(uniqid(mt_rand(), true)); // Or whatever you prefer to generate a token
            $newUser->setConfirmationToken($token);
            $this->get('fos_user.user_manager')->updateUser($newUser, false);
            $this->getDoctrine()->getManager()->flush();
            $mailer = $this->get('fos_user.mailer');
            $retorno = $mailer->sendConfirmationEmailMessage($newUser);
            //$this->session->set('fos_user_send_confirmation_email/email', $user->getEmail());
            return $this->redirectToRoute('admin_users_edit', array('id' => $newUser->getId()));
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($user, false);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_users_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush($user);
        }

        return $this->redirectToRoute('admin_users_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_users_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function deactivateAction(Request $request, User $user)
    {
        $user->setEnabled(false);
        $this->get('fos_user.user_manager')->updateUser($user);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_users_index');
    }

    public function activateAction(Request $request, User $user)
    {
        $user->setEnabled(true);
        $this->get('fos_user.user_manager')->updateUser($user);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_users_index');
    }
}
