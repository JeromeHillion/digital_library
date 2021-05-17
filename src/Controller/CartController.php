<?php


namespace App\Controller;

use App\Entity\User;
use App\Service\Cart\CartService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends abstractController
{

    /**
     * @Route("/library/panier", name="cart_index")
     */

    public function index(CartService $cartService)
    {
        $cartDatas = $cartService->getFullCart();
        $quantity = 0;
        foreach ($cartDatas as $item) {
            $quantity += $item['quantity'];
        
        }
        $user = $this->getUser();
/* dd($user->getFirstName()); */
        return $this->render('Cart/index.html.twig', [
            'items' => $cartDatas,
            'quantity' => $quantity
        ]);
    }

    /**
     * @Route("/library/panier/add/{id}", name="cart_add")
     */

    public function add($id, CartService $cartService)
    {
        $cartService->add($id);

        return $this->json([
            'code' => 200,
            'message' => 'Le livre a bien été ajouté !',
            'id' => $id
        ]);
    }

    /**
     * @Route("/library/panier/delete/{id}", name="cart_delete")
     */

    public function delete($id, CartService $cartService)
    {
        $cartService->delete($id);

        return $this->json([
            'code' => 200,
            'message' => 'Le livre a bien été supprimé !',
            'id' => $id
        ]);
    }



    /**
     * @Route("/library/panier/more", name="cart_plus")
     */

    public function more(CartService $cartService)
    {
        $cart = $cartService->getFullCart();


        return $this->json([
            'code' => 200,
            'cart' => $cart
        ]);
    }
}
