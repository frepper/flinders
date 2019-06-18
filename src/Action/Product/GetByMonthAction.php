<?php


namespace App\Action\Product;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class GetByMonthAction
{

    private $manager;

    /**
     * GetByMonthAction constructor.
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }


    /**
     * @Route(
     *     name="products_get_by_month",
     *     path="/products/monthly",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Product::class,
     *         "_api_collection_operation_name"="get_by_month"
     *     },
     * )
     */
    public function __invoke()
    {
        $result = [];
        $products = $this->manager->getRepository('App:Product')->getSalesByMonth();
        return new JsonResponse($products);
    }
}
