<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Compte;
use App\Form\UserType;
use App\Entity\Caissier;
use App\Repository\CaissierRepository;
use App\Form\CompteType;
use App\Form\CaissierType;;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



/**
 * @Route("/api")
 */
class CaissierController extends AbstractController
{

      
    /**
     * @Route("/caissier", name="caisssier", methods={"POST","GET"})
     * //@IsGranted("ROLE_SUPERADMIN")
     */


    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager):Response
    {
        $mat = date('y');
        $idrep = $this->getDoctrine()->getRepository(Caissier::class)->CreateQueryBuilder('a')
            ->select('Max(a.id)')
            ->getQuery();
        $maxidresult = $idrep->getResult();
        $maxid = ($maxidresult[0][1] + 1);
        $mat .= "-CA@ssI" . $maxid;
        $caissier = new Caissier();
        $user = new User();
            $form=$this->createForm(UserType::class, $user);
            $form->handleRequest($request);
            $datas=$request->request->all();
            $file=$request->files->all()['imageFile'];
            $form->submit($datas); 
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('password')->getData()
                    ));
                $user->setRoles(["ROLE_CAISSIER"]);
                $user->setStatut("debloquer");
                $user->setCaissier($caissier);
                $user->setImageFile($file);
                $user->setUpdatedAt(new \DateTime('now'));
                $entityManager->persist($user);

          
            
            $form = $this->createForm(CaissierType::class, $caissier);
            $form->handleRequest($request);
            $data = $request->request->all();
            $form->submit($data);
            $caissier->setAuthent($user);
            $caissier->setMatricule($mat); 
            $caissier->setRole("caissier");
            if(!$caissier->getAuthent())
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce user est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($caissier);
           
            $entityManager->flush();

            return new Response('Inserré',Response::HTTP_CREATED);
    }
/**
     * @Route("/listcaissier", name="caissierlist", methods={"GET"})
     */
    public function list(CaissierRepository $caissierRepository, SerializerInterface $serializer): Response
    {
       $list=$caissierRepository->findAll();
       $data=$serializer->serialize($list, 'json',['groups' => ['caissier']]);

       return new Response($data, 200, [
        'Content-Type' => 'application/json'
    ]);
    }
    /**
     * @Route("/{id}", name="caissier_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Caissier $caissier): Response
    {
        return $this->render('caissier/show.html.twig', [
            'caissier' => $caissier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="caissier_edit", methods={"GET","POST"}, requirements={"id":"\d+"})
     */
    public function edit(Request $request, Caissier $caissier): Response
    {
        $form = $this->createForm(CaissierType::class, $caissier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caissier_index');
        }

        return $this->render('caissier/edit.html.twig', [
            'caissier' => $caissier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caissier_delete", methods={"DELETE"}, requirements={"id":"\d+"})
     */
    public function delete(Request $request, Caissier $caissier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caissier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caissier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('caissier_index');
    }

 
    
}
