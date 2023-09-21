<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Company;
use App\Repository\SalesRepository;
use App\Repository\CompanyRepository;

class CompanyController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private CompanyRepository $companyRepository;
    private SalesRepository $salesRepository;

    public function __construct(
        CompanyRepository $companyRepository,
        SalesRepository $salesRepository
    )
    {
        $this->companyRepository = $companyRepository;
        $this->salesRepository = $salesRepository;
    }

    // #[Route('/', name: 'index')]
    // public function index(): Response
    // {
    //     return $this->render('index.html.twig');
    // }

    #[Route('/', name: 'companies')]
    public function index(): Response
    {
        $companies = $this->companyRepository->findAll();

        $data = [];
        foreach ($companies as $company) {
            $companyId = $company->getId();
            $totalSales = $this->salesRepository->getCompanySales($companyId);
    
            $data[] = [
                'companyId' => $companyId,
                'companyName' => $company->getCompanyName(),
                'totalSales' => number_format($totalSales, 2),
            ];
        }

        return $this->render('insurance/index.html.twig', [
            'companies' => $data,
        ]);
    }

    #[Route('/api/companies', name: 'api_companies')]
    public function getCompaniesApi(): JsonResponse
    {
        $companies = $this->companyRepository->findAll();
        if(!$companies){
            $error = [
                'status' => 'success',
                'code' => 204,
                'error' => 'No company added yet'
            ];
            return new JsonResponse($error);
        }

        $data = [];
        foreach ($companies as $company) {
            $companyId = $company->getId();
            $totalSales = $this->salesRepository->getCompanySales($companyId);
    
            $data[] = [
                'status' => 'error',
                'code' => 200,
                'companyId' => $companyId,
                'companyName' => $company->getCompanyName()
            ];
        }
        
        return new JsonResponse($data);
    }
    
    #[Route('/api/companies/{id}/sales', name: 'api_company_sales')]
    public function getCompanySales(int $id): JsonResponse
    {
        $company = $this->companyRepository->find($id);
        if(!$company){
            $error = [
                'status' => 'error',
                'code' => 404,
                'error' => 'No company found with id ' . $id
            ];
            return new JsonResponse($error);
        }
        $data = [
            'status' => 'error',
            'code' => 200,
            'id' => $company->getId(),
            'company' => $company->getCompanyName(),
            'totalSales' => number_format($this->salesRepository->getCompanySales($company->getId()), 2),
        ];
        
        return new JsonResponse($data);
    }

   
}
