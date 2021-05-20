<?php

namespace App\Service\Loan;

use DateTime;
use App\Entity\Loan;
use App\Entity\User;
use App\Entity\Books;
use App\Service\Cart\CartService;
use App\Repository\BooksRepository;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
/*Classe service pour la gestion des commandes */

class LoanService
{
    protected $cartService;
    protected $booksRepository;
    private $security;

   

    public function __construct(CartService $cartService, BooksRepository $booksRepository, Security $security, EntityManagerInterface $entityManager)
    {
        $this->cartService = $cartService;
        $this->booksRepository = $booksRepository;
        $this->security = $security; 
        $this->entityManager = $entityManager; 
       
      
    }

    public function add() {

    $cart = $this->cartService->getFullCart();

 $entityManager = $this->entityManager->getDoctrine()->getManager();
    $loan = new Loan();
    foreach ($cart as $item){
             /* $books = $this->booksRepository->findBy(["id" => $bookCopyId]);*/
                  $loan->addBookCopyId($item['book']); 
                
             $loan->setStatus('Confirmé');
               $loan->setDateLoan(new DateTime('now'));
              
               $user = $this->security->getUser();
               $loan->setUserId($user);
        
          
      
    }
  
    $entityManager->persist($loan);
    $entityManager->flush();


    return $this-> $entityManager->redirectToRoute('index');
    }
}
