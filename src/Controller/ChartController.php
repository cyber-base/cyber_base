<?php

namespace App\Controller;


use Monolog\Handler\Curl\Util;
use Symfony\UX\Chartjs\Model\Chart;
use App\Repository\UsagerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Callback;
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
                    $usagerCatSalarie = round((($salarie[0][1] / $usagerTotal[0][1]) * 100),2),
                    $usagerCatretraite = ($retraite[0][1] / $usagerTotal[0][1]) * 100,
                    $usagerDemandeurDemploi = ($demandeurDemploi[0][1] / $usagerTotal[0][1]) * 100,
                    $usagerCollegue = ($catCollegue[0][1] / $usagerTotal[0][1]) * 10,
                    $usagerEtudiant = ($catEtudiant[0][1] / $usagerTotal[0][1]) * 100,
                    $usagerScolaire = ($catScolaire[0][1] / $usagerTotal[0][1]) * 100,
                    $usagerAssociation = number_format(($catAssociation[0][1] / $usagerTotal[0][1]) * 100,2),
                    $usagerCentreDeLoisir = ($catCentreDeLoisir[0][1] / $usagerTotal[0][1]) * 100,
                    $usagerAntennesDeQuartier = ($catAntennesDeQuartier[0][1] / $usagerTotal[0][1]) * 100,
                    // dump($usagerCatSalarie),
                    'data' => [
                        $usagerCatretraite, $usagerDemandeurDemploi, $usagerCollegue, $usagerScolaire, $usagerEtudiant, $usagerAssociation, $usagerCentreDeLoisir, $usagerAntennesDeQuartier
                    ],
                ],

            ],

        ]);

        // $chart->setOptions([
        //     'scales' => [
        //         'y' => [
        //             'ticks' => ["callback"=>function($value,$index,$ticks){return $value."%";}]
        //         ],
        //     ],
        // ]);
        return $this->render('chart/index.html.twig', [
            'chart' => $chart,

            'data' => [
                $usagerCatSalarie, $usagerCatretraite, $usagerDemandeurDemploi, $usagerCollegue, $usagerEtudiant, $usagerScolaire, $usagerAssociation, $usagerCentreDeLoisir, $usagerAntennesDeQuartier
            ],
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


    #[Route('/chart2/{annees}/{mois}', name: 'app_chart2', methods: ['GET'])]
    public function index(Request $request, String $annees, String $mois, UsagerRepository $usagerRepository, ChartBuilderInterface $chartBuilder): Response
    {
        // var_dump($annees);
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $semaine = ['Monday', ' Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        foreach ($semaine as $jour) {
            $horaires = [
                'neufEtDix' => $usagerRepository->countHeure($annees, $mois, '9H', '10H', $jour),
                'dixEtOnze' => $usagerRepository->countHeure($annees, $mois, '10H', '11H', $jour),
                'onzeEtDouze' => $usagerRepository->countHeure($annees, $mois, '11H', '12H', $jour),
                'douzeEtTreize' => $usagerRepository->countHeure($annees, $mois, '12H', '13H', $jour),
                'treizeEtQuatorze' => $usagerRepository->countHeure($annees, $mois, '13H', '14H', $jour),
                'quatorzeEtQuinze' => $usagerRepository->countHeure($annees, $mois, '14H', '15H', $jour),
                'quinzeEtSeize' => $usagerRepository->countHeure($annees, $mois, '15H', '16H', $jour),
                'seizeEtDixSept' => $usagerRepository->countHeure($annees, $mois, '16H', '17H', $jour),
                'dixSeptEtDixHuit' => $usagerRepository->countHeure($annees, $mois, '17H', '18H', $jour),
                'dixHuitEtDixNeuf' => $usagerRepository->countHeure($annees, $mois, '18H', '19H', $jour),
            ];
        }
        $heures =  [
            '9h00-10h00', '10h00-11h00', '11h00-12h00', '12h00-13h00', '13h00-14h00', '14h00-15h00', '15h00-16h00', '16h00-17h00', '17h00-18h00', '18h00-19h00'
        ];
        
        // var_dump($semaine);
        
        $neufEtDix = $usagerRepository->countHeure($annees, $mois, '9H', '10H', $jour);
        $dixEtOnze = $usagerRepository->countHeure($annees, $mois, '10H', '11H', $jour);
        $onzeEtDouze = $usagerRepository->countHeure($annees, $mois, '11H', '12H', $jour);
        $douzeEtTreize = $usagerRepository->countHeure($annees, $mois, '12H', '13H', $jour);
        $treizeEtQuatorze = $usagerRepository->countHeure($annees, $mois, '13H', '14H', $jour);
        $QuatorzeEtQuinze = $usagerRepository->countHeure($annees, $mois, '14H', '15H', $jour);
        $quinzeEtSeize = $usagerRepository->countHeure($annees, $mois, '15H', '16H', $jour);
        $seizeEtDixSept = $usagerRepository->countHeure($annees, $mois, '16H', '17H', $jour);
        $dixSeptEtDixHuit = $usagerRepository->countHeure($annees, $mois, '17H', '18H', $jour);
        $dixHuitEtDixNeuf = $usagerRepository->countHeure($annees, $mois, '18H', '19H', $jour);
        var_dump( $neufEtDix);
        $chart->setData([

            'labels' => [
                '9h00-10h00', '10h00-11h00', '11h00-12h00', '12h00-13h00', '13h00-14h00', '14h00-15h00', '15h00-16h00', '16h00-17h00', '17h00-18h00', '18h00-19h00'
            ],
            'datasets' => [
                [

                    'data' => [
                        $neufEtDix[0][1], $dixEtOnze[0][1], $onzeEtDouze[0][1], $douzeEtTreize[0][1], $treizeEtQuatorze[0][1],
                        $QuatorzeEtQuinze[0][1], $quinzeEtSeize[0][1], $seizeEtDixSept[0][1], $dixSeptEtDixHuit[0][1], $dixHuitEtDixNeuf[0][1]
                    ],
                    'fill' => false,
                    // 'borderColor' => 'rgb(100, 192, 192)',
                    'tension' => 0.1



                ],

            ],
            'hoverOffset' => 20,
        ]);


        return $this->render('chart/chart2.html.twig', [
            'heures' => $heures,
            'semaine' => $semaine,
            'jour' => $jour,
            'horaires' => $horaires,
            'chart' => $chart,
            'data' => [
                $neufEtDix[0][1], $dixEtOnze[0][1], $onzeEtDouze[0][1], $douzeEtTreize[0][1], $treizeEtQuatorze[0][1],
                $QuatorzeEtQuinze[0][1], $quinzeEtSeize[0][1], $seizeEtDixSept[0][1], $dixSeptEtDixHuit[0][1], $dixHuitEtDixNeuf[0][1]
            ],
            

    


           
           
        ]);
    }


}
