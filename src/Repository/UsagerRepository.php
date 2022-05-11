<?php

namespace App\Repository;

use App\Entity\Usager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method Usager|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usager|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usager[]    findAll()
 * @method Usager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsagerRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usager::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Usager $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Usager $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Usager) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }


    public function countByUsager()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'select count(u.genre) from App\Entity\Usager u'
            );
        return $query->getResult();
    }
    public function countByCategorie()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'select u.categorie from App\Entity\Usager u'
            );
        return $query->getResult();
    }


    public function countUsagerByGenreFemme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.genre) from App\Entity\Usager u where u.genre = 'Femme'"
            );
        return $query->getResult();
    }

    public function countUsagerByGenreHomme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.genre) from App\Entity\Usager u where u.genre = 'Homme'"
            );
        return $query->getResult();
    }


    public function countSalarieByUsager()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) like '%salarié'"
            );
        return $query->getResult();
    }

    public function countRetraiteByUsager()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) like '%retraité'"
            );
        return $query->getResult();
    }
    public function countDemandeurDemploiByUsager()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%demandeur d''emploi'"
            );
        return $query->getResult();
    }
    public function countCollegueByUsager()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%collègue'"
            );
        return $query->getResult();
    }
    public function countEtudiantByUsager()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%etudiant'"
            );
        return $query->getResult();
    }
    public function countScolaireByUsager()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%scolaire'"
            );
        return $query->getResult();
    }
    public function countAssociationByUsager()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%association'"
            );
        return $query->getResult();
    }
    public function countCentreDeLoisirByUsager()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%Centre De Loisirs'"
            );
        return $query->getResult();
    }
    public function countAntennesDeQuartierByUsager()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%Antenne de quartiers'"
            );
        return $query->getResult();
    }
    public function countSalarieByUsagerHomme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%salarié' AND u.genre = 'Homme'"
            );
        return $query->getResult();
    }
    public function countRetraiteByUsagerHomme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%retraité' AND u.genre = 'Homme'"
            );
        return $query->getResult();
    }
    public function countDemandeurDemploiByUsagerHomme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%demandeur d''emploi' AND u.genre = 'Homme'"
            );
        return $query->getResult();
    }
    public function countCollegueByUsagerHomme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%collegue' AND u.genre = 'Homme'"
            );
        return $query->getResult();
    }
    public function countEtudiantByUsagerHomme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%etudiant' AND u.genre = 'Homme'"
            );
        return $query->getResult();
    }
    public function countScolaireByUsagerHomme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%scolaire' AND u.genre = 'Homme'"
            );
        return $query->getResult();
    }
    public function countAssociationByUsagerHomme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%association' AND u.genre = 'Homme'"
            );
        return $query->getResult();
    }
    public function countCentreDeLoisirsByUsagerHomme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%CentreDeLoisirs' AND u.genre = 'Homme'"
            );
        return $query->getResult();
    }
    public function countAntenneDeQuartierByUsagerHomme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%antenne de quartiers' AND u.genre = 'Homme'"
            );
        return $query->getResult();
    }
    public function countSalarieByUsagerFemme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%salarié' AND u.genre = 'Femme'"
            );
        return $query->getResult();
    }
    public function countRetraiteByUsagerFemme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%retraité' AND u.genre = 'Femme'"
            );
        return $query->getResult();
    }
    public function countDemandeurDemploiByUsagerFemme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%demandeur d''emploi' AND u.genre = 'Femme'"
            );
        return $query->getResult();
    }
    public function countCollegueByUsagerFemme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%collegue' AND u.genre = 'Femme'"
            );
        return $query->getResult();
    }
    public function countEtudiantByUsagerFemme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%etudiant' AND u.genre = 'Femme'"
            );
        return $query->getResult();
    }
    public function countScolaireByUsagerFemme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%scolaire' AND u.genre = 'Femme'"
            );
        return $query->getResult();
    }
    public function countAssociationByUsagerFemme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%association' AND u.genre = 'Femme'"
            );
        return $query->getResult();
    }
    public function countCentreDeLoisirsByUsagerFemme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%CentreDeLoisirs' AND u.genre = 'Femme'"
            );
        return $query->getResult();
    }
    public function countAntenneDeQuartierByUsagerFemme()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(u.categorie) from App\Entity\Usager u where lower(u.categorie) LIKE '%antenne de quartiers' AND u.genre = 'Femme'"
            );
        return $query->getResult();
    }
    public function count3dCreationByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%3dCreation'"
            );
        return $query->getResult();
    }
    public function countAccessByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%access'"
            );
        return $query->getResult();
    }
    public function countAchatVenteByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%achatVente'"
            );
        return $query->getResult();
    }
    public function countAlbumPhotoByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%AlbumPhoto'"
            );
        return $query->getResult();
    }
    public function countArnaquesWebByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%ArnaquesWeb'"
            );
        return $query->getResult();
    }
    public function countBlogByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Blog'"
            );
        return $query->getResult();
    }
    public function countClavierByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Clavier'"
            );
        return $query->getResult();
    }

    public function countCleUsbByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%CleUsb'"
            );
        return $query->getResult();
    }

    public function countCmsByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Cms'"
            );
        return $query->getResult();
    }

    public function countConferenceByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Conference'"
            );
        return $query->getResult();
    }

    public function countCreationDeSiteWebByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%CreationDeSiteWeb'"
            );
        return $query->getResult();
    }

    public function countDossierByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Dossier'"
            );
        return $query->getResult();
    }
    public function countAdministrationByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Administration'"
            );
        return $query->getResult();
    }

    public function countEmailDebutantByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%EmailDebutant'"
            );
        return $query->getResult();
    }

    public function countEmailExpertByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%EmailExpert'"
            );
        return $query->getResult();
    }

    public function countEmploiByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Emploi'"
            );
        return $query->getResult();
    }

    public function countExcelDebutantByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%ExcelDebutant'"
            );
        return $query->getResult();
    }

    public function countExcelExpertByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%ExcelExpert'"
            );
        return $query->getResult();
    }

    public function countGraphismeByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Graphisme'"
            );
        return $query->getResult();
    }

    public function countGraverByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Graver'"
            );
        return $query->getResult();
    }

    public function countInstallLogicielsByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%InstallLogiciels'"
            );
        return $query->getResult();
    }

    public function countInternetDebutantByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%InternetDebutant'"
            );
        return $query->getResult();
    }

    public function countInternetExpertByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%InternetExpert'"
            );
        return $query->getResult();
    }

    public function countJeuxByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Jeux'"
            );
        return $query->getResult();
    }

    public function countLinuxByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Linux'"
            );
        return $query->getResult();
    }

    public function countLogicielsGratuitsByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%LogicielsGratuits'"
            );
        return $query->getResult();
    }

    public function countMacOsxByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%MacOSX'"
            );
        return $query->getResult();
    }

    public function countMaoByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Mao'"
            );
        return $query->getResult();
    }

    public function countMontageArtistiqueByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%MontageArtistique'"
            );
        return $query->getResult();
    }

    public function countMontagePcByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%MontagePc'"
            );
        return $query->getResult();
    }

    public function countMontageVideoByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%MontageVideo'"
            );
        return $query->getResult();
    }

    public function countNettoyageSecuriteByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%NettoyageSecurite'"
            );
        return $query->getResult();
    }

    public function countOrdiDeAaZByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%OrdiDeAaZ'"
            );
        return $query->getResult();
    }

    public function countPaoByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Pao'"
            );
        return $query->getResult();
    }

    public function countPdfByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Pdf'"
            );
        return $query->getResult();
    }

    public function countPhotoDebutantByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%PhotoDebutant'"
            );
        return $query->getResult();
    }

    public function countPhotoExpertByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%PhotoExpert'"
            );
        return $query->getResult();
    }

    public function countPhotoshopByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Photoshop'"
            );
        return $query->getResult();
    }

    public function countPimByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Pim'"
            );
        return $query->getResult();
    }

    public function countPowerPointByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%PowerPoint'"
            );
        return $query->getResult();
    }

    public function countProgrammationByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Programmation'"
            );
        return $query->getResult();
    }

    public function countPublisherByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Publisher'"
            );
        return $query->getResult();
    }

    public function countRetouchePhotoByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%RetouchePhoto'"
            );
        return $query->getResult();
    }

    public function countScannerByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Scanner'"
            );
        return $query->getResult();
    }

    public function countSourisByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Souris'"
            );
        return $query->getResult();
    }

    public function countTabletteSmartphoneByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%TabletteSmartphone'"
            );
        return $query->getResult();
    }

    public function countTrucagePhotoByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%TrucagePhoto'"
            );
        return $query->getResult();
    }

    public function countWindowsByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%Windows'"
            );
        return $query->getResult();
    }

    public function countWordExpertByLibelleAtelier()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.libelle) LIKE '%WordExpert'"
            );
        return $query->getResult();
    }

    public function countHeure($jour,$annees,$mois,$debut,$fin)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.heureDebut) = '$debut' AND lower(a.heureFin) = '$fin' and a.date like '$annees-$mois%' and DayName(a.date) like '$jour%'"
            );
        return $query->getResult();
    }

    public function countHeureDeDixEtOnze()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.heureDebut) = '10H' AND lower(a.heureFin) = '11H'"
            );
        return $query->getResult();
    }

    public function countHeureDeOnzeEtDouze()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.heureDebut) = '11H' AND lower(a.heureFin) = '12H'"
            );
        return $query->getResult();
    }

    public function countHeureDeDouzeEtTreize()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.heureDebut) = '12H' AND lower(a.heureFin) = '13H'"
            );
        return $query->getResult();
    }

    public function countHeureDeTreizeEtQuatorze()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.heureDebut) = '13H' AND lower(a.heureFin) = '14H'"
            );
        return $query->getResult();
    }

    public function countHeureDeQuatorzeEtQuinze()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.heureDebut) = '14H' AND lower(a.heureFin) = '15H'"
            );
        return $query->getResult();
    }

    public function countHeureDeQuinzeEtSeize()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.heureDebut) = '15H' AND lower(a.heureFin) = '16H'"
            );
        return $query->getResult();
    }

    public function countHeureDeSeizeEtDixSept()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.heureDebut) = '16H' AND lower(a.heureFin) = '17H'"
            );
        return $query->getResult();
    }


    public function countHeureDeDixseptEtDixHuit()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.heureDebut) = '17H' AND lower(a.heureFin) = '18H'"
            );
        return $query->getResult();
    }

    public function countHeureDeDixhuitEtDixNeuf()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "select count(a.libelle) from App\Entity\Atelier a where lower(a.heureDebut) = '18H' AND lower(a.heureFin) = '19H'"
            );
        return $query->getResult();
    }


    // /**
    //  * @return Usager[] Returns an array of Usager objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Usager
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
