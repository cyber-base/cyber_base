<?php

namespace App\Controller;


use Symfony\UX\Chartjs\Model\Chart;
use App\Repository\UsagerRepository;
use Monolog\Handler\Curl\Util;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ANIMATEUR')]
class ChartController extends AbstractController
{
    // #[Route('/chart2', name: 'app_chart_new')]
    // public function index(ChartBuilderInterface $chartBuilder): Response
    // {
    //     $chart = $chartBuilder->createChart(Chart::TYPE_RADAR);
    //     $chart->setData([
    //         'labels' => ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
    //         'datasets' => [
    //             [
    //                 'label' => 'My First dataset',
    //                 'backgroundColor' => 'rgb(255, 99, 132)',
    //                 'borderColor' => 'rgb(255, 99, 132)',
    //                 'data' => [0, 10, 5, 2, 20, 30, 45],
    //             ],
    //         ],
    //     ]);


    //     return $this->render('chart/chart.html.twig', [
    //         'chart' => $chart,
    //     ]);
    // }

    #[Route('/chart ', name: 'app_chart')]
    public function countChart(UsagerRepository $usagerRepository, ChartBuilderInterface $chartBuilder): Response
    {

        $chart = $chartBuilder->createChart(Chart::TYPE_PIE);
        $chart->setData([
            
            'labels' => ['Salariés', 'Retraités', 'Demandeur d\'emploi', 'Collègues', 'Etudiants', 'Scolaires', 'Associations', 'Centre de loisirs', 'Antennes de quartier'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(70, 159, 25)',
                        'rgb(24, 106, 162)',
                        'rgb(77, 37, 121)',
                        'rgb(180, 23, 70)',
                        'rgb(23, 180, 148)',
                        'rgb(180, 177, 23)',
                        'rgb(83, 177, 243)',
                        'rgb(30, 33, 36)'
                    ],
                    $usagerTotal = $usagerRepository->countByUsager(),
                    $salarie = $usagerRepository->countSalarieByUsager(),
                    $retraite = $usagerRepository->countRetraiteByUsager(),
                    $demandeurDemploi = $usagerRepository->countDemandeurDemploiByUsager(),
                    $catCollegue = $usagerRepository->countCollegueByUsager(),
                    $catEtudiant = $usagerRepository->countEtudiantByUsager(),
                    $catScolaire = $usagerRepository->countScolaireByUsager(),
                    $catAssociation = $usagerRepository->countAssociationByUsager(),
                    $catCentreDeLoisir = $usagerRepository->countCentreDeLoisirByUsager(),
                    $catAntennesDeQuartier = $usagerRepository->countAntennesDeQuartierByUsager(),
                    $usagerCatSalarie = ($salarie[0][1] / $usagerTotal[0][1])*100,
                    $usagerCatretraite = ($retraite[0][1] / $usagerTotal[0][1])*100,
                    $usagerDemandeurDemploi = ($demandeurDemploi[0][1] / $usagerTotal[0][1])*100,
                    $usagerCollegue = ($catCollegue[0][1] / $usagerTotal[0][1])*10,
                    $usagerEtudiant = ($catEtudiant[0][1] / $usagerTotal[0][1])*100,
                    $usagerScolaire = ($catScolaire[0][1] / $usagerTotal[0][1])*100,
                    $usagerAssociation = ($catAssociation[0][1] / $usagerTotal[0][1])*100,
                    $usagerCentreDeLoisir = ($catCentreDeLoisir[0][1] / $usagerTotal[0][1])*100,
                    $usagerAntennesDeQuartier = ($catAntennesDeQuartier[0][1] / $usagerTotal[0][1])*100,
                    // dump($usagerCatSalarie),
                    'data' =>[$usagerCatSalarie, $usagerCatretraite, $usagerDemandeurDemploi, $usagerCollegue,$usagerScolaire, $usagerEtudiant ,$usagerAssociation
                    , $usagerCentreDeLoisir, $usagerAntennesDeQuartier],
                    

                ],
                
            ],
            'hoverOffset' => 4,
            
        ]);
        return $this->render('chart/index.html.twig', [
            'chart' => $chart,

            'data' => [$usagerCatSalarie , $usagerCatretraite, $usagerDemandeurDemploi, $usagerCollegue, $usagerEtudiant,$usagerScolaire,$usagerAssociation 
            , $usagerCentreDeLoisir , $usagerAntennesDeQuartier],
            'countUsager' => $usagerRepository->countByUsager(),
            'genreFemme' => $usagerRepository->countUsagerByGenreFemme(),
            'genreHomme' => $usagerRepository->countUsagerByGenreHomme(),
            'catSalarie' => $usagerRepository->countSalarieByUsager(),
            'catRetraite' => $usagerRepository->countRetraiteByUsager(),
            'catDemandeurDemploi' => $usagerRepository->countDemandeurDemploiByUsager(),
            'catCollegue' => $usagerRepository->countCollegueByUsager(),
            'catEtudiant' => $usagerRepository->countEtudiantByUsager(),
            'catScolaire' => $usagerRepository->countScolaireByUsager(),
            'catAssociation' => $usagerRepository->countAssociationByUsager(),
            'catCentreDeLoisir' => $usagerRepository->countCentreDeLoisirByUsager(),
            'catAntennesDeQuartier' => $usagerRepository->countAntennesDeQuartierByUsager(),
            'catSalarieByUsagerHomme' => $usagerRepository->countSalarieByUsagerHomme(),
            'catRetraiteByUsagerHomme' => $usagerRepository->countRetraiteByUsagerHomme(),
            'catDemandeurDemploiByUsagerHomme' => $usagerRepository->countDemandeurDemploiByUsagerHomme(),
            'catCollegueByUsagerHomme' => $usagerRepository->countCollegueByUsagerHomme(),
            'catEtudiantByUsagerHomme' => $usagerRepository->countEtudiantByUsagerHomme(),
            'catScolaireByUsagerHomme' => $usagerRepository->countScolaireByUsagerHomme(),
            'catAssociationByUsagerHomme' => $usagerRepository->countAssociationByUsagerHomme(),
            'catCentreDeLoisirsByUsagerHomme' => $usagerRepository->countCentreDeLoisirsByUsagerHomme(),
            'catAntenneDeQuartierByUsagerHomme' => $usagerRepository->countAntenneDeQuartierByUsagerHomme(),
            'catSalarieByUsagerFemme' => $usagerRepository->countSalarieByUsagerFemme(),
            'catRetraiteByUsagerFemme' => $usagerRepository->countRetraiteByUsagerFemme(),
            'catDemandeurDemploiByUsagerFemme' => $usagerRepository->countDemandeurDemploiByUsagerFemme(),
            'catCollegueByUsagerFemme' => $usagerRepository->countCollegueByUsagerFemme(),
            'catEtudiantByUsagerFemme' => $usagerRepository->countEtudiantByUsagerFemme(),
            'catScolaireByUsagerFemme' => $usagerRepository->countScolaireByUsagerFemme(),
            'catAssociationByUsagerFemme' => $usagerRepository->countAssociationByUsagerFemme(),
            'catCentreDeLoisirsByUsagerFemme' => $usagerRepository->countCentreDeLoisirsByUsagerFemme(),
            'catAntenneDeQuartierByUsagerFemme' => $usagerRepository->countAntenneDeQuartierByUsagerFemme(),
            'lib3dCreationByLibelleAtelier' => $usagerRepository->count3dCreationByLibelleAtelier(),
            'libAccessByLibelleAtelier' => $usagerRepository->countAccessByLibelleAtelier(),
            'libAchatVenteByLibelleAtelier' => $usagerRepository->countAchatVenteByLibelleAtelier(),
            'libAlbumPhotoByLibelleAtelier' => $usagerRepository->countAlbumPhotoByLibelleAtelier(),
            'libArnaquesWebByLibelleAtelier' => $usagerRepository->countArnaquesWebByLibelleAtelier(),
            'libBlogByLibelleAtelier' => $usagerRepository->countBlogByLibelleAtelier(),
            'libClavierByLibelleAtelier' => $usagerRepository->countClavierByLibelleAtelier(),
            'libCleUsbByLibelleAtelier' => $usagerRepository->countCleUsbByLibelleAtelier(),
            'libCmsByLibelleAtelier' => $usagerRepository->countCmsByLibelleAtelier(),
            'libConferenceByLibelleAtelier' => $usagerRepository->countConferenceByLibelleAtelier(),
            'libCreationDeSiteWebByLibelleAtelier' => $usagerRepository->countCreationDeSiteWebByLibelleAtelier(),
            'libDossierByLibelleAtelier' => $usagerRepository->countDossierByLibelleAtelier(),
            'libAdministrationByLibelleAtelier' => $usagerRepository->countAdministrationByLibelleAtelier(),
            'libEmailDebutantByLibelleAtelier' => $usagerRepository->countEmailDebutantByLibelleAtelier(),
            'libEmailExpertByLibelleAtelier' => $usagerRepository->countEmailExpertByLibelleAtelier(),
            'libEmploiByLibelleAtelier' => $usagerRepository->countEmploiByLibelleAtelier(),
            'libExcelDebutantByLibelleAtelier' => $usagerRepository->countExcelDebutantByLibelleAtelier(),
            'libExcelExpertByLibelleAtelier' => $usagerRepository->countExcelExpertByLibelleAtelier(),
            'libGraphismeByLibelleAtelier' => $usagerRepository->countGraphismeByLibelleAtelier(),
            'libGraverByLibelleAtelier' => $usagerRepository->countGraverByLibelleAtelier(),
            'libInstallLogicielsByLibelleAtelier' => $usagerRepository->countInstallLogicielsByLibelleAtelier(),
            'libInternetDebutantByLibelleAtelier' => $usagerRepository->countInternetDebutantByLibelleAtelier(),
            'libInternetExpertByLibelleAtelier' => $usagerRepository->countInternetExpertByLibelleAtelier(),
            'libJeuxByLibelleAtelier' => $usagerRepository->countJeuxByLibelleAtelier(),
            'libLinuxByLibelleAtelier' => $usagerRepository->countLinuxByLibelleAtelier(),
            'libLogicielsGratuitsByLibelleAtelier' => $usagerRepository->countLogicielsGratuitsByLibelleAtelier(),
            'libMacOsxByLibelleAtelier' => $usagerRepository->countMacOsxByLibelleAtelier(),
            'libMaoByLibelleAtelier' => $usagerRepository->countMaoByLibelleAtelier(),
            'libMontageArtistiqueByLibelleAtelier' => $usagerRepository->countMontageArtistiqueByLibelleAtelier(),
            'libMontagePcByLibelleAtelier' => $usagerRepository->countMontagePcByLibelleAtelier(),
            'libMontageVideoByLibelleAtelier' => $usagerRepository->countMontageVideoByLibelleAtelier(),
            'libNettoyageSecuriteByLibelleAtelier' => $usagerRepository->countNettoyageSecuriteByLibelleAtelier(),
            'libOrdiDeAaZByLibelleAtelier' => $usagerRepository->countOrdiDeAaZByLibelleAtelier(),
            'libPaoByLibelleAtelier' => $usagerRepository->countPaoByLibelleAtelier(),
            'countPdfByLibelleAtelier' => $usagerRepository->countPdfByLibelleAtelier(),
            'libPhotoDebutantByLibelleAtelier' => $usagerRepository->countPhotoDebutantByLibelleAtelier(),
            'libPhotoExpertByLibelleAtelier' => $usagerRepository->countPhotoExpertByLibelleAtelier(),
            'libPhotoshopByLibelleAtelier' => $usagerRepository->countPhotoshopByLibelleAtelier(),
            'libPimByLibelleAtelier' => $usagerRepository->countPimByLibelleAtelier(),
            'libPowerPointByLibelleAtelier' => $usagerRepository->countPowerPointByLibelleAtelier(),
            'libProgrammationByLibelleAtelier' => $usagerRepository->countProgrammationByLibelleAtelier(),
            'libPublisherByLibelleAtelier' => $usagerRepository->countPublisherByLibelleAtelier(),
            'libRetouchePhotoByLibelleAtelier' => $usagerRepository->countRetouchePhotoByLibelleAtelier(),
            'libScannerByLibelleAtelier' => $usagerRepository->countScannerByLibelleAtelier(),
            'libSourisByLibelleAtelier' => $usagerRepository->countSourisByLibelleAtelier(),
            'libTabletteSmartphoneByLibelleAtelier' => $usagerRepository->countTabletteSmartphoneByLibelleAtelier(),
            'libTrucagePhotoByLibelleAtelier' => $usagerRepository->countTrucagePhotoByLibelleAtelier(),
            'countWindowsByLibelleAtelier' => $usagerRepository->countWindowsByLibelleAtelier(),
            'libWordExpertByLibelleAtelier' => $usagerRepository->countWordExpertByLibelleAtelier(),




            
            







        ]);
    }


    #[Route('/chart2', name: 'app_chart2', methods: ['GET'])]
    public function index(UsagerRepository $usagerRepository,ChartBuilderInterface $chartBuilder): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $huitEtNeuf = $usagerRepository->countHeureDeNeufEtDix();
        $neufEtDix =  $usagerRepository->countHeureDeDixEtOnze();
        $dixEtOnze = $usagerRepository->countHeureDeDixEtOnze();
        $dixEtOnze = $usagerRepository->countHeureDeOnzeEtDouze();
        $douzeEtTreize = $usagerRepository->countHeureDeDouzeEtTreize();
        $treizeEtQuatorze = $usagerRepository->countHeureDeTreizeEtQuatorze();
        $QuatorzeEtQuinze = $usagerRepository->countHeureDeQuatorzeEtQuinze();
        $quinzeEtSeize = $usagerRepository->countHeureDeQuinzeEtSeize();
        $seizeEtDixSept = $usagerRepository->countHeureDeSeizeEtDixSept();
        $dixSeptEtDixHuit = $usagerRepository->countHeureDeDixseptEtDixHuit();
        $dixHuitEtDixNeuf = $usagerRepository->countHeureDeDixhuitEtDixNeuf();
        $chart->setData([
            
            'labels' => ['9h00-10h00', '10h00-11h00', '11h00-12h00', '12h00-13h00', '13h00-14h00', '14h00-15h00', '15h00-16h00'
            ,'16h00-17h00', '17h00-18h00','18h00-19h00'],
            'datasets' => [
                [
                    'label' => 'Lundi',
                    'data' => [$huitEtNeuf[0][1],$neufEtDix[0][1],$dixEtOnze[0][1],$douzeEtTreize[0][1],$treizeEtQuatorze[0][1],
                    $QuatorzeEtQuinze[0][1],$quinzeEtSeize[0][1],$seizeEtDixSept[0][1],$dixSeptEtDixHuit[0][1],$dixHuitEtDixNeuf[0][1]],
                    'fill' => false,
                    // 'borderColor' => 'rgb(100, 192, 192)',
                    'tension' => 0.1
                    
                    

                ],
                
            ],
            'hoverOffset' => 20,
        ]);
        $days = ceil(abs( strtotime('2000-01-25') - strtotime('2010-02-20') ) / 86400);
        // $months = ;
        $MOIS = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet'
        ,'Août', 'Septembre','Octobre', 'Novembre', 'Décembre'];
        

        return $this->render('chart/chart2.html.twig', [
        'diff' => $days,
        'chart' => $chart,
        'neufEtDix' => $usagerRepository->countHeureDeNeufEtDix(),
        'dixEtOnze' => $usagerRepository->countHeureDeDixEtOnze(),
        'onzeEtDouze' => $usagerRepository->countHeureDeOnzeEtDouze(),
        'douzeEtTreize' => $usagerRepository->countHeureDeDouzeEtTreize(),
        'treizeEtQuatorze' => $usagerRepository->countHeureDeTreizeEtQuatorze(),
        'quatorzeEtQuinze' => $usagerRepository->countHeureDeQuatorzeEtQuinze(),
        'quinzeEtSeize' => $usagerRepository->countHeureDeQuinzeEtSeize(),
        'seizeEtDixSept' => $usagerRepository->countHeureDeSeizeEtDixSept(),
        'dixSeptEtDixHuit' => $usagerRepository->countHeureDeDixseptEtDixHuit(),
        'dixHuitEtDixNeuf' => $usagerRepository->countHeureDeDixhuitEtDixNeuf(),
        ]);
    }
}