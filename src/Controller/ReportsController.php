<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *
 * @Route("/reports")
 *
 * Class ReportsController
 * @package App\Controller
 */
class ReportsController extends AbstractController
{
    /**
      @Route("/sales")
     *
     * @param Request $request
     * @return  Response
     */
    public function salesAction(Request $request) {
        return $this->render('reports/sales.html.twig');
    }

}