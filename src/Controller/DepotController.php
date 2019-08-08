<?php

namespace App\Controller;

use App\Entity\Depot;
use App\Entity\Compte;
use App\Form\DepotType;
use App\Entity\Caissier;
use App\Form\Depot1Type;
use App\Repository\DepotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\VarExporter\Internal\Values;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api")
 */
class DepotController extends AbstractController
{
    /**
     * @Route("/", name="depot_index", methods={"GET"})
     */
    public function index(DepotRepository $depotRepository): Response
    {
        return $this->render('depot/index.html.twig', [
            'depots' => $depotRepository->findAll(),
        ]);
    }

    /**
     * @Route("/depot", name="depot", methods={"GET","POST"})
     * @IsGranted("ROLE_CAISSIER")
     */
    public function new(Request $request, EntityManagerInterface $entityManager):Response
    {
        $values = json_decode($request->getContent());
        $depot= new Depot();
        $form = $this->createForm(DepotType::class, $depot);
                $form->handleRequest($request);
                $data = $request->request->all();
                $form->submit($data);
 
            $depot->setDate(new \DateTime());
            $depot->setMontant($values->montant);

            $compte = $this->getDoctrine()->getRepository(Compte::class)->find($values->compte);
           
            $depot->setCompte($compte);
            if(!$depot->getCompte())
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce compte est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }
            $compte->setSolde($compte->getSolde() + $values->montant);
            $caissier = $this->getDoctrine()->getRepository(Caissier::class)->find($values->caissier);
            $depot->setCaissier($caissier);
            if(!$depot->getCaissier())
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce caissier est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }

            if($values->montant<75000)
            {

                $petit = [
                    'status' => 404,
                    'message' => 'Vous ne pouvez déposer un montant inférieure à 75 000 !!!'
                ];
                return new JsonResponse($petit, 404);  
            }
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($depot);
            $entityManager->flush(); 

           return new Response('Inserré',Response::HTTP_CREATED);

    }

    /**
     * @Route("/{id}", name="depot_show", methods={"GET"})
     */
    public function show(Depot $depot): Response
    {
        return $this->render('depot/show.html.twig', [
            'depot' => $depot,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="depot_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Depot $depot): Response
    {
        $form = $this->createForm(Depot1Type::class, $depot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('depot_index');
        }

        return $this->render('depot/edit.html.twig', [
            'depot' => $depot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="depot_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Depot $depot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$depot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($depot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('depot_index');
    }
}
