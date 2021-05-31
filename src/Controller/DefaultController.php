<?php

namespace App\Controller;

use App\Entity\Details;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends AbstractController {

    /**
     * @Route("/default", name="default")
     */
    public function index(): Response {
        $details = $this->getDoctrine()->getRepository(Details::class)->findAll();
        return $this->render('default/index.html.twig', [
            'details' => $details
        ]);
    }

    /**
     * @Route("/addDetails", name="add_details")
     */
    public function addDetails(Request $request): Response {
        $details = new Details();

        $form = $this->createFormBuilder($details)
                ->add('name', TextType::class)
                ->add('phone', TextType::class)
                ->add('save', SubmitType::class, ['label' => 'Submit'])
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($details);
            $em->flush();
            return new Response(json_encode(['status' => 'success']));
//            return $this->redirectToRoute('default');
        }
        return $this->render('default/addDetails.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

}
