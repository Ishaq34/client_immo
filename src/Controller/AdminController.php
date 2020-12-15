<?php

namespace App\Controller;

use App\Repository\ImmovableRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="home_admin", methods={"GET"})
     * @param ImmovableRepository $immovableRepository
     * @return Response
     */
    public function homeAdmin(ImmovableRepository $immovableRepository): Response
    {
        //$pieChart = new PieChart();
        $barChart = new BarChart();
        $barChart->getData()->setArrayToDataTable(
            [['Task', 'Hours per Day'],
                ['Work',     11],
                ['Eat',      2],
                ['Commute',  2],
                ['Watch TV', 2],
                ['Sleep',    7]
            ]
        );
        //$pieChart->getOptions()->setTitle('My Daily Activities');
        $barChart->getOptions()->setHeight(500);
        $barChart->getOptions()->setWidth(900);
        //$pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        //$pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        //$pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        //$pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $barChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('admin/home.html.twig', [
            'piechart' => $barChart,
            'immovables' => $immovableRepository->findAll(),
        ]);
        /*return $this->render('admin/home.html.twig', [
            'controller_name' => 'AdminController'
        ]);*/
    }

    /**
     * @Route("/admin/index", name="immovable_index_admin", methods={"GET"})
     * @param ImmovableRepository $immovableRepository
     * @return Response
     */
    public function indexAdmin(ImmovableRepository $immovableRepository): Response
    {
        return $this->render('admin/index_admin.html.twig', [
            'immovables' => $immovableRepository->findAll(),
            'controller_name' => 'AdminController'
        ]);
    }
}
