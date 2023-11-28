<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ProductsRepository $productrepository): Response
    {
        $products = $productrepository->findAll();
        // dd($products);
        return $this->render('main/index.html.twig', [
            'product' => $products,
        ]);
    }
}
