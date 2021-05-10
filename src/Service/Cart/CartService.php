<?php


namespace App\Service\Cart;

use App\Repository\BooksRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/*Classe Service pour la gestion du panier*/

class CartService
{
    protected $session;
    protected $booksRepository;
    public function __construct(SessionInterface $session, BooksRepository $booksRepository)
    {
        $this->session = $session;
        $this->booksRepository = $booksRepository;
    }

    /*Fonction qu va permettre d'ajouter un livre dans le panier */
    public function add(int $id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->session->set('cart', $cart);
    }

    /*Fonction qu va permettre de un livre dans le panier */
    public function delete(int $id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $this->session->set('cart', $cart);
    }
    public function getFullCart(): array
    {
        $cart = $this->session->get('cart', []);
        $cartData = [];

        foreach ($cart as $id => $quantity) {
            $cartData[] = [
                'book' => $this->booksRepository->find($id),
                'quantity' => $quantity
            ];
        }
        /*dd($cartData);*/
        return $cartData;
    }
}