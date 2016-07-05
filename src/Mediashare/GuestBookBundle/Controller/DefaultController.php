<?php

namespace Mediashare\GuestBookBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mediashare\GuestBookBundle\Entity\GuestBook;
use Mediashare\GuestBookBundle\Form\GuestBookType;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MediashareGuestBookBundle:GuestBook')->findAll();


        $entity = new GuestBook();
        $form   = $this->createCreateForm($entity);

        return $this->render('MediashareGuestBookBundle:Default:index.html.twig', array(
            'entities' => $entities,
            'entity' => $entity,
            'form'   => $form->createView(),
        ));

    }


    /**
     * Creates a new GuestBook entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new GuestBook();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Commentaire site')
                ->setFrom($entity->getEmail())
                ->setTo($this->container->getParameter('mail_to'))
                ->setBody($this->renderView('MediashareAppBundle:Mail:guestbook.html.twig', array(
                    'entity' => $entity
                )))
                ->setContentType('text/html');
            $this->get('mailer')->send($message);

           // return $this->redirect($this->generateUrl('mediashare_app_thanks'));
            // message de retour
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Votre commentaire à été pris en compte, merci.'
            );

            return $this->redirect($this->generateUrl('guestbook'));
        }

        return $this->render('MediashareGuestBookBundle:GuestBook:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a GuestBook entity.
     *
     * @param GuestBook $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(GuestBook $entity)
    {
        $form = $this->createForm(new GuestBookType(), $entity, array(
            'action' => $this->generateUrl('guestbook_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit',
            array(
                'label' => 'Enregistrer',
                'attr' => array('class' => 'btn btn-success')
            ));

        return $form;
    }


}
