<?php

namespace App\Controller;

use App\Form\ProfileEditFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="main_profile_index")
     */
    public function index(): Response
    {
        return $this->render('main/profile/index.html.twig');
    }

    /**
     * @param  Request  $request
     * @return Response
     * @Route ("profile/edit", name="mail_profile_edit")
     */
    public function edit(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileEditFormType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('main_profile_index');
        }
        return $this->render('main/profile/edit.html.twig',[
            'profileEditForm' => $form->createView(),
        ] );
    }
}
