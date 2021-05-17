<?php

namespace App\Controller;

use App\Entity\Loan;
use App\Service\Loan\LoanService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    public function add(LoanService $loanService){
        $loan = new Loan();
        dd($loanService->add());
    }

}
