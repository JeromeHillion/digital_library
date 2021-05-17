<?php

namespace App\Service\Loan;

use DateTime;
use App\Entity\Loan;
use App\Entity\User;
use App\Entity\Books;
use App\Service\Cart\CartService;
use App\Repository\BooksRepository;
use Symfony\Component\Security\Core\Security;

/*Classe service pour la gestion des commandes */

class LoanService
{
    protected $cartService;
    protected $booksRepository;
    private $security;
   

    public function __construct(CartService $cartService, BooksRepository $booksRepository, Security $security)
    {
        $this->cartService = $cartService;
        $this->booksRepository = $booksRepository;
        $this->security = $security;
       
      
    }

    public function add() {

    $cart = $this->cartService->getFullCart();
    $loan = new Loan();
    foreach ($cart as $item){
             /* $books = $this->booksRepository->findBy(["id" => $bookCopyId]);*/
                  $loan->addBookCopyId($item['book']); 
                
             $loan->setStatus('Confirmé');
               $loan->setDateLoan(new DateTime('now'));
               /** @var \App\Entity\User $user */
               $user = $this->security->getUser();
               $loan->setUserId($user);
        
        
      
    }

       return $loan;
    }
}
