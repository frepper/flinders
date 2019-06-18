<?php


namespace App\Entity\Repository;


use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function getSalesByMonth() {
        $this->setSqlMode();
        $queryBuilder = $this->createQueryBuilder('product')
            ->select('product, DATE_FORMAT(sales.date,\'%Y-%m\') as date, SUM(sales.quantity) as quantity, SUM(sales.price) as price')
            ->join('product.sales', 'sales')
            ->orderBy('product.id, sales.date', 'ASC')
            ->groupBy('product.id, date');
        return $queryBuilder->getQuery()->getResult(AbstractQuery::HYDRATE_ARRAY);
    }

    public function setSqlMode() {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}