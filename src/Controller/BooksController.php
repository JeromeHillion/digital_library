<?php

namespace App\Controller;

use App\Entity\Authors;
use App\Entity\Books;
use App\Entity\Category;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BooksController extends AbstractController
{
    /**
     * @Route("/admin/addBooks", name="admin_addBooks")
     */
    public function addBooks()
    {

        $json = json_decode(file_get_contents(dirname(__DIR__) . '/BooksApi/books.json'));

        foreach ($json as $data) {
            $newBook = new Books();
            $author = new Authors();
            $category = new Category();

            $data_authors =[];
            $data_categories =[];

            $newBook->setName($data->name);
            $newBook->setPublication(new DateTime($data->publication));
            $newBook->setCover($data->cover);
            $newBook->setSummary($data->summary);
            array_push($data_authors, $data->author);
            array_push($data_categories, $data->category);
           
            foreach($data_authors as $data_author){
                $author->setName($data_author->name);
                $newBook->addAuthor($author);
            }
           
            foreach($data_categories as $data_category){
                $category->setName($data_category->name);
                $newBook->addCategory($category);
            }
            $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($newBook);
                $entityManager->flush();
            }
            

dd($newBook);
        }    
       
    }

