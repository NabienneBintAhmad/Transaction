<?php

namespace App\Controller;

use App\Entity\Tarif;
use App\Entity\Compte;
use App\Entity\Transaction;
use App\Form\TransactionType;
use App\Entity\TypeTransaction;
use App\Entity\UserPrestataire;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TransactionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api")
 */
class TransactionController extends AbstractController
{
    /**
     * @Route("/", name="transaction_index", methods={"GET"})
     */
    public function index(TransactionRepository $transactionRepository): Response
    {
        return $this->render('transaction/index.html.twig', [
            'transactions' => $transactionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/envoie", name="transaction_new", methods={"GET","POST"})
     * //@IsGranted("ROLE_USER")
     */
    public function new(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer): Response
    {
       $values = json_decode($request->getContent());
        //
        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        
        //
        $data = $request->request->all();

        $form->submit($data);

       $form->handleRequest($request);

        $code=random_int(10000, 90000);
        if ($form->isSubmitted()) 
        {

            $transaction->setDate(new \DateTime());
            $transaction->setCode($code);
           $montant=$form->get('montant')->getData();
            $taxe = $this->getDoctrine()->getRepository(Tarif::class)->findAll();
                  foreach ($taxe as $values) 
            {
                $values->getBI();
                $values->getBS();
                $values->getPrix();
                if ($montant >= $values->getBI() && $montant <= $values->getBS()) 
                {
                    $tarif= $values->getPrix();
                    $commission=($tarif*10)/100;
  ;
                    break;
                }
            }
            $transaction->setCommission($values);
            $libelle= $this->getDoctrine()->getRepository(TypeTransaction::class)->findOneBy(['libelle'=>$data]);
            $transaction->setLibelle($libelle) ; 
             
            $findcompte= $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numero'=>$data]);
            $multiserv= $this->getDoctrine()->getRepository(UserPrestataire::class)->findOneBy(['matriculeEntreprise'=>$data]);
            $transaction->setLibelle($multiserv) ; 
            var_dump($multiserv); die();
            if(!$findcompte)
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce compte de travail n\' est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            } 

            if ($findcompte->getSolde() > $transaction->getMontant())
             {
                
              $findcompte->setSolde($findcompte->getSolde()-$transaction->getMontant()+$commission);
                $errors = $validator->validate($transaction);
                if (count($errors))
                 {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500);
                }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($transaction);
            $entityManager->flush();

            return new Response('Inserré. Voici le code : ' . $transaction->getCode(),Response::HTTP_CREATED);
          }

    return new Response('Pas envoyé',Response::HTTP_UNAUTHORIZED);
  }
    }
    /**
     * @Route("/{id}", name="transaction_show", methods={"GET"})
     */
    public function show(Transaction $transaction): Response
    {
        return $this->render('transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="transaction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Transaction $transaction): Response
    {
        $form = $this->createForm(Transaction1Type::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redifindcomptetToRoute('transaction_index');
        }

        return $this->render('transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transaction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Transaction $transaction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($transaction);
            $entityManager->flush();
        }

        return $this->redifindcomptetToRoute('transaction_index');
    }
}