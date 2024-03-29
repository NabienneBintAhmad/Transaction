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
use App\Repository\UserRepository;
use App\Entity\User;
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
  
                    break;
                }
            }
            $transaction->setCommission($values);
            $transaction->setComEnv($commission);
           
            $transaction->setLibelle('envoie') ; 
            $transaction->setStatut('Pas retiré!') ; 
          
            $findcompte=$this->getUser()->getCompteTravail();
            $admin=$this->getUser()->getAdmin();
            $transaction->setAdminEnv($admin);
           // dump($connex);die();entityManager
            //$connex;
           // dump($connex->getCompteTravail()); die();
            //$findcompte= $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['id'=>$connex]);
           // dump($findcompte);die();
            $multiservi=$this->getUser()->getPrestataire();
           // dump($multiservice);die();
            $multiservice= $this->getDoctrine()->getRepository(UserPrestataire::class)->find($multiservi);
           
            $transaction->setMultiservice($multiservice) ; 
            
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

    return new Response('Pas envoyé! Votre compte ne vous le permet pas',Response::HTTP_UNAUTHORIZED);
  }
    }


    /**
     * @Route("/infotarif", name="infotarif", methods={"GET","POST"})
     */
    public function infotarif(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer){
    $value = json_decode($request->getContent());
        $montant= $value->montant;
        $taxe = $this->getDoctrine()->getRepository(Tarif::class)->findAll();
        foreach ($taxe as $values) 
  {
      $values->getBI();
      $values->getBS();
      $values->getPrix();
      if ($montant >= $values->getBI() && $montant <= $values->getBS()) 
      {
          $tarif= $values;
          break;
      }
  }
  $data = $serializer->serialize($tarif, 'json');
  return new Response($data,200, [
      'Content-Type' => 'application/json'
  ]);

        }

/**
     * @Route("/inforetrait", name="inforetrait", methods={"GET","POST"})
     */
    public function inforetrait(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, SerializerInterface $serializer){
        $value = json_decode($request->getContent());
            $code= $value->code;
            // $envoyeurNomComplet= $value->envoyeurNomComplet;
            // $recepteurNomComplet= $value->recepteurNomComplet;
            $info = $this->getDoctrine()->getRepository(Transaction::class)->findAll();
            foreach ($info as $values) 
      {
          $values->getStatut();
          $values->getRecepteurNomComplet();
          $values->getEnvoyeurNomComplet();
          $values->getCode();
          $values->getMontant();
          if ($code==$values->getcode()) 
          {
              $inforetrait= $values;
              break;
          }
      }
      $data = $serializer->serialize($inforetrait, 'json');
      return new Response($data,200, [
          'Content-Type' => 'application/json'
      ]);
    
            }


    /**
     * @Route("/retrait", name="retrait", methods={"GET","POST"})
     */
    public function retrait(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator,  SerializerInterface $serializer): Response
    {
        
      
       // $transaction=new Transaction();
        $datas=$request->request->all();
        $findcompte=$this->getUser()->getCompteTravail();
           
           // $findcompte= $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['id'=>$connex->getCompteTravail()]);
      
        $multiserv=$this->getUser()->getPrestataire();
        $multiservice= $this->getDoctrine()->getRepository(UserPrestataire::class)->find($multiserv);
           
           // $multiservice= $this->getDoctrine()->getRepository(UserPrestataire::class)->findOneBy(['authent'=> $multiserv->getPrestataire()]);
             if(!$multiservice)
             {
                 $notfound = [
                     'status' => 404,
                     'message' => 'Ce service n\' est pas trouvé'
                 ];
     
                 return new JsonResponse($notfound, 404);    
             } 
        
        if(!$findcompte)
        {
            $notfound = [
                'status' => 404,
                'message' => 'Ce compte de travail n\' est pas trouvé'
            ];

            return new JsonResponse($notfound, 404);    
        } 

        $envoyer=$this->getDoctrine()->getRepository(Transaction::class)->findOneBy(['envoyeurNomComplet'=>$datas]);
        $recepteur=$this->getDoctrine()->getRepository(Transaction::class)->findOneBy(['recepteurNomComplet'=>$datas]);
        $code=$this->getDoctrine()->getRepository(Transaction::class)->findOneBy(['code'=>$datas]);

         $transaction=$this->getDoctrine()->getRepository(Transaction::class)->findOneBy(['code'=>$datas]);
       // dump($code->getCode());die();

          if(!$code)
        {
            throw $this->createNotFoundException('Ce code n\'existe pas sur la base de données!');
        }
        if(!$envoyer)
        {
            throw $this->createNotFoundException('Ce envoyeur n\'exite pas sur la base de données!');
        }
        if(!$recepteur)
        {
            throw $this->createNotFoundException('Ce recepteur n\'exite pas sur la base de données!');
        }
        $statut=$transaction->getStatut();
        if($statut=="retiré"){

            throw $this->createNotFoundException('Cette transaction est déja retiré!');
       
        }
        $transaction->setServiceRetrait($multiservice) ; 
        $transaction->setDateRetrait(new \DateTime()); 
       
       
        $a=$datas['recepteurCni'];
       
       if($a)
        { 
        
           
                $taxe = $this->getDoctrine()->getRepository(Tarif::class)->findAll();
                foreach ($taxe as $values) 
          {
              $values->getBI();
              $values->getBS();
              $values->getPrix();
              if ($transaction->getMontant() >= $values->getBI() && $transaction->getMontant() <= $values->getBS());
              {
                  $tarif= $values->getPrix();
                  $commission=($tarif*20)/100;

                  break;
              }
          }

          $transaction->SetStatut("retiré");
          $transaction->SetComRet($commission);
          $transaction->SetRecepteurCni($a);
          $admin=$this->getUser()->getAdmin();
          $transaction->setAdminRet($admin);
          $findcompte->setSolde($findcompte->getSolde()+$transaction->getMontant()+$commission);
              $errors = $validator->validate($transaction);
              if (count($errors))
               {
                  $errors = $serializer->serialize($errors, 'json');
                  return new Response($errors, 500);
              }
          
            $entityManager->flush();
            //dump($entityManager->flush());die();
           
            $data = [
                'status' => 201,
                'message' => 'Retrait effectué!, montant : '
            ];
            return new JsonResponse($data);
        }
       
        
    
    $data = [
        'status' => 401,
        'message' => 'Retrait pas effectué!'
    ];
    return new JsonResponse($data);
}
    /**
     * @Route("/listtransac", name="transactionlist", methods={"GET","POST"})
     */
    public function list(TransactionRepository $transRepository, SerializerInterface $serializer): Response
    {
        $trans=$this->getUser()->getPrestataire();
         $list=$transRepository->find($trans);
       $data=$serializer->serialize($list, 'json',
       ['groups' => ['transaction']]);

       return new Response($data, 200, [
        'Content-Type' => 'application/json'
    ]);
    }

     /**
     * @Route("/{id}", name="transaction_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Transaction $transaction): Response
    {
        return $this->render('transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="transaction_edit", methods={"GET","POST"}, requirements={"id":"\d+"})
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
     * @Route("/{id}", name="transaction_delete", methods={"DELETE"}, requirements={"id":"\d+"})
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


    /**
     * @Route("/listerperiodeEnvoie", name="listerperiodeEnvoie", methods={"POST", "GET"})
     */

    public function listerperiode(ValidatorInterface $validator, Request $request, TransactionRepository $transRepository,SerializerInterface $serializer)
    {
   
        $values = json_decode($request->getContent(),true);

        $debut=$values['debut'];
        $fin = $values['fin'];
        //dump($values);
        $user =$this->getUser()->getUserpresta()->getId();
        //dump($user);
        if ($debut=="" && $fin=="") {

            $debut = (new DateTime);
            $fin = (new DateTime);
        
        } elseif ($debut=="" && $fin!="") {

            $debut = (new \DateTime($fin));
            $fin = (new \DateTime($fin));
        } elseif ($debut!="" &&  $fin=="") {

            $debut = (new \DateTime($debut));
            $fin = (new \DateTime());

        } elseif ($debut!="" &&  $fin!="") {
            $debut = (new \DateTime($debut));
            $fin = (new \DateTime($fin));
        }

        // $datetime = date("Y-m-d H:i:s");
        // echo $datetime;
 
  
   

        $transaction = $transRepository->findByPeriode($debut,$fin,$user);
       // dump($transaction);
        $data = $serializer->serialize($transaction, 'json',['groups'=>['envoie']]);

      
      return new Response(
          $data,
          200,
          [
              'Content-Type' => 'application/json'
          ]
      );
    }


 /**
     * @Route("/listerperiodeEnvoieAdmin", name="listerperiodeEnvoieAdmin", methods={"POST", "GET"})
     */

    public function listerperiodeEnvoieAdmin(ValidatorInterface $validator, Request $request, TransactionRepository $transRepository,SerializerInterface $serializer)
    {

 
        $values = json_decode($request->getContent(),true);

        $debut=$values['debut'];
        $fin = $values['fin'];
        //dump($values);
        $user =$this->getUser()->getAdmin()->getId();
        // dump($user);
        if ($debut=="" && $fin=="") {

            $debut = (new DateTime);
            $fin = (new DateTime);
        
        } elseif ($debut=="" && $fin!="") {

            $debut = (new \DateTime($fin));
            $fin = (new \DateTime($fin));
        } elseif ($debut!="" &&  $fin=="") {

            $debut = (new \DateTime($debut));
            $fin = (new \DateTime());

        } elseif ($debut!="" &&  $fin!="") {
            $debut = (new \DateTime($debut));
            $fin = (new \DateTime($fin));
        }

        $transaction = $transRepository->findByPeriodeAdmin($debut,$fin,$user);
       // dump($transaction);
        $data = $serializer->serialize($transaction, 'json',['groups'=>['envoie']]);

      
      return new Response(
          $data,
          200,
          [
              'Content-Type' => 'application/json'
          ]
      );
    }


     /**
     * @Route("/listerperiodeRetraitAdmin", name="listerperiodeRetraitAdmin", methods={"POST", "GET"})
     */

    public function listerperiodeRetraitAdmin(ValidatorInterface $validator, Request $request, TransactionRepository $transRepository,SerializerInterface $serializer)
    {
       
     
        $values = json_decode($request->getContent(),true);

        $debut=$values['debut'];
        $fin = $values['fin'];
        //dump($values);
        $user =$this->getUser()->getAdmin()->getId();
        // dump($user);
        if ($debut=="" && $fin=="") {

            $debut = (new DateTime);
            $fin = (new DateTime);
        
        } elseif ($debut=="" && $fin!="") {

            $debut = (new \DateTime($fin));
            $fin = (new \DateTime($fin));
        } elseif ($debut!="" &&  $fin=="") {

            $debut = (new \DateTime($debut));
            $fin = (new \DateTime());

        } elseif ($debut!="" &&  $fin!="") {
            $debut = (new \DateTime($debut));
            $fin = (new \DateTime($fin));
        }
        $transaction = $transRepository->findByPeriodeRetraitAdmin($debut,$fin,$user);
       // dump($transaction);
        $data = $serializer->serialize($transaction, 'json',['groups'=>['retrait']]);

      
      return new Response(
          $data,
          200,
          [
              'Content-Type' => 'application/json'
          ]
      );
    }


    /**
     * @Route("/listerperiodeRetrait", name="listerperiodeRetrait", methods={"POST", "GET"})
     */

    public function listerperiodeRetrait(ValidatorInterface $validator, Request $request, TransactionRepository $transRepository,SerializerInterface $serializer)
    {

    
        $values = json_decode($request->getContent(),true);

        $debut=$values['debut'];
        $fin = $values['fin'];
        //dump($values);
        $user =$this->getUser()->getUserpresta()->getId();
        //dump($user);
        if ($debut=="" && $fin=="") {

            $debut = (new DateTime);
            $fin = (new DateTime);
        
        } elseif ($debut=="" && $fin!="") {

            $debut = (new \DateTime($fin));
            $fin = (new \DateTime($fin));
        } elseif ($debut!="" &&  $fin=="") {

            $debut = (new \DateTime($debut));
            $fin = (new \DateTime());

        } elseif ($debut!="" &&  $fin!="") {
            $debut = (new \DateTime($debut));
            $fin = (new \DateTime($fin));
        }

        $transaction = $transRepository->findByPeriodeRetrait($debut,$fin,$user);
       // dump($transaction);
        $data = $serializer->serialize($transaction, 'json',['groups'=>['retrait']]);

      
      return new Response(
          $data,
          200,
          [
              'Content-Type' => 'application/json'
          ]
      );
    }
  
}

