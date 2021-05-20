<?php

namespace App\Controller;

use DateTime;
use App\Entity\Loan;
use App\Service\Cart\CartService;
use App\Service\Loan\LoanService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class LoanController extends AbstractController
{
    #[Route('/loan', name: 'loan')]
    public function index(): Response
    {
        return $this->render('loan/index.html.twig', [
            'controller_name' => 'LoanController',
        ]);
    }

   /**
    * @Route("/add", name="add_loan")
    */

    public function add(CartService $cartService, Security  $security){
        $cart = $cartService->getFullCart();

 $entityManager = $this->getDoctrine()->getManager();
    $loan = new Loan();
    foreach ($cart as $item){
             /* $books = $this->booksRepository->findBy(["id" => $bookCopyId]);*/
                  $loan->setBookId($item['book']); 
                
             $loan->setStatus('Confirmé');
               $loan->setDateLoan(new DateTime('now'));
              
               $user = $security->getUser();
               $loan->setUserId($user);
        
          
      
    }
  
    $entityManager->persist($loan);
    $entityManager->flush();


    return $this->$entityManager->redirectToRoute('index');
    }

}
