<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Depot;
use App\Entity\Compte;
use App\Form\DepotType;
use App\Entity\Caissier;
use App\Form\Depot1Type;
use App\Repository\DepotRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\VarExporter\Internal\Values;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api")
 */
class DepotController extends AbstractController
{
    /**
     * @Route("/j", name="depot_index", methods={"GET"})
     */
    public function index(DepotRepository $depotRepository): Response
    {
        return $this->render('depot/index.html.twig', [
            'depots' => $depotRepository->findAll(),
        ]);
    }

    /**
     * @Route("/depot", name="depot", methods={"GET","POST"})
     * //@IsGranted("ROLE_CAISSIER")
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
           
           //$depot->setMontant($values->montant);
           $connex=$this->getUser();
            //  $connex->getId();
           
            $caissier =$this->getDoctrine()->getRepository(Caissier::class)->findOneBy(['authent'=>  $connex]);
         
            $depot->setCaissier($caissier);
           //dump($depot->setCaissier($caissier)); die();
            $compte = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numero'=>$data]);
           
            $depot->setCompte($compte);
            if(!$compte)
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce compte est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }
            $compte->setSolde($compte->getSolde() + $depot->getMontant());

            if(!$caissier)
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce caissier est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }

            if($depot->getMontant()<75000)
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
     * @Route("/listdepot", name="depot_list", methods={"GET"})
     */
    public function list(DepotRepository $depotRepository, SerializerInterface $serializer): Response
    {
        $depot=$this->getUser()->getCaissier();
       // dump($depot);
        $list = $depotRepository->findBy(["caissier" => $depot]);
        //$list=$depotRepository->find($depot);
        $data=$serializer->serialize($list, 'json', ['groups' => ['depot']]);

       return new Response($data, 200, [
        'Content-Type' => 'application/json'
    ]);
    }

    /**
     * @Route("/{id}", name="depot_show", methods={"GET"}, requirements={"id":"\d+"})
     *  //@ParamConverter("depot", class="SensioBlogBundle:Depot")
     */
    public function show(Depot $depot): Response
    {
        return $this->render('depot/show.html.twig', [
            'depot' => $depot,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="depot_edit", methods={"GET","POST"}, requirements={"id":"\d+"})
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
     * @Route("/{id}", name="depot_delete", methods={"DELETE"}, requirements={"id":"\d+"})
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
