<?php

namespace App\Controller;

use App\Entity\OS;
use App\Form\OSType;
use App\Repository\OSRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/o/s")
 */
class OSController extends AbstractController
{
    /**
     * @Route("/", name="o_s_index", methods="GET")
     */
    public function index(OSRepository $oSRepository): Response
    {
        return $this->render('o_s/index.html.twig', ['o_ss' => $oSRepository->findAll()]);
    }

    /**
     * @Route("/new", name="o_s_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $o = new OS();
        $form = $this->createForm(OSType::class, $o);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($o);
            $em->flush();

            return $this->redirectToRoute('o_s_index');
        }

        return $this->render('o_s/new.html.twig', [
            'o' => $o,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="o_s_show", methods="GET")
     */
    public function show(OS $o): Response
    {
        return $this->render('o_s/show.html.twig', ['o' => $o]);
    }

    /**
     * @Route("/{id}/edit", name="o_s_edit", methods="GET|POST")
     */
    public function edit(Request $request, OS $o): Response
    {
        $form = $this->createForm(OSType::class, $o);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('o_s_edit', ['id' => $o->getId()]);
        }

        return $this->render('o_s/edit.html.twig', [
            'o' => $o,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="o_s_delete", methods="DELETE")
     */
    public function delete(Request $request, OS $o): Response
    {
        if ($this->isCsrfTokenValid('delete'.$o->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($o);
            $em->flush();
        }

        return $this->redirectToRoute('o_s_index');
    }
}
