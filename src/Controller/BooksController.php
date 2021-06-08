<?php

namespace App\Controller;

use App\Entity\Authors;
use App\Entity\Books;
use App\Entity\Category;
use App\Repository\BooksRepository;
use App\Repository\CategoryRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BooksController extends AbstractController
{
    /**
     * @Route("/admin/addBooks", name="admin_addBooks")
     */
    public function addBooks(CategoryRepository $categoryRepository)
    {
        $array_cat = [];
        $json = json_decode(file_get_contents(dirname(__DIR__) . '/BooksApi/books.json'));
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($json as $data) {
            $newBook = new Books();
            /*$author = new Authors();*/


            foreach ($data->category as $cat) {
                array_push($array_cat, $cat);
                $category_list = array_unique($array_cat);


                foreach ($category_list as $item_cat) {
                    $cat_bdd = $categoryRepository->findOneBy(["name" => $item_cat]);

                    $category = new Category();
                    if (isset($cat_bdd)) {
                        $category = $cat_bdd;


                    } else {
                        $category->setName($item_cat);
                        $entityManager->persist($category);
                        $entityManager->flush();

                    }
                    /* dd($item_cat);*/
                    $newBook->setName($data->name);
                    $newBook->setPublication(new DateTime($data->publication));
                    $newBook->setCover($data->cover);
                    $newBook->setSummary($data->summary);
                    $newBook->setCategory($category);
                    $entityManager->persist($newBook);
                    $entityManager->flush();

                }


            }


        }
        return new Response('Mise à jour ok !');
    }

}

