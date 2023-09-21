<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class SalesController extends AbstractController
{
    #[Route('/sales', name: 'app_sales')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SalesController.php',
        ]);
    }

    /**
     * @Route("/insurance-companies", name="insurance_companies")
     */
    // public function index(): Response
    // {
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $repository = $entityManager->getRepository(Company::class);

    //     // Fetch the list of insurance companies
    //     $companies = $repository->findAll();

    //     // Calculate the sum of sales for each company
    //     foreach ($companies as $company) {
    //         $sales = $company->getSales();
    //         $totalSales = 0;

    //         foreach ($sales as $sale) {
    //             $totalSales += $sale->getAmount();
    //         }

    //         $company->setTotalSales($totalSales);
    //     }

    //     return $this->render('insurance/index.html.twig', [
    //         'companies' => $companies,
    //     ]);
    // }
}
