<?php

namespace App\Repository;

use App\Entity\Telephone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Telephone|null find($id, $lockMode = null, $lockVersion = null) //récupère en fonction de l'id
 * @method Telephone|null findOneBy(array $criteria, array $orderBy = null) //récupère un objet en fonction du ou des critères donné(s)
 * @method Telephone[]    findAll() //récupère tous les objets de la DB sous forme d'un tableau d'objets
 * @method Telephone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) //récupère un ou plusieurs objet(s) en fonction du ou des critères donné(s)
 */

/*Exemple findBy
$criteria = ["marque" => "Samsung", "taille" => 5.6];
$orderBy = ["marque" => "ASC", "taille" => "DESC"];
*/


class TelephoneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Telephone::class);
    }

//    /**
//     * @return Telephone[] Returns an array of Telephone objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    /*
    public function findOneBySomeField($value): ?Telephone
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /*Récupération téléphones les plus grands*/
    public function findBiggerSizeThan($value) {
        // doit renvoyer un tableau d'entités correspondant à la contrainte
        // comme la fonction findBy par exemple

        $em = $this->getEntityManager(); 

        // création de la requête
        $query = $em->createQuery(
            'SELECT t 
            FROM App\Entity\Telephone t 
            WHERE t.taille > :size'
        )->setParameter('size', $value);

        // exécution et renvoi de la requête sous la forme de tableau d'entités
        return $query->execute();
    }


    /*Recherche par marque*/
    public function findBrand($value) {
        $em = $this->getEntityManager();


        $query = $em->createQuery(
            'SELECT t
            FROM App\Entity\Telephone t
            WHERE t.marque LIKE :search
            ORDER BY t.marque ASC'
        )->setParameter('search', '%'.$value.'%');
        return $query->execute();
    }


    /*Recherche par marque QueryBuilder*/
    public function findBrandQb($value, $valueType) {

        //on travaille sur l'entité Telephone (le repo est associé à l'entité Telephone), alias 't'
        $qb = $this->createQueryBuilder('t');

        if ($value !== "0" && $valueType !== "0") { /*si la marque ET le type sont donnés, on recherche avec les 2 critères*/
            $qb->where('t.marque LIKE :searchMarque')
                ->andWhere('t.type LIKE :searchType')
                ->setParameters(array('searchMarque' => '%'.$value.'%', 'searchType' => '%'.$valueType.'%'));
        

        } else if($value !== "0") { /*si la marque est donnée*/
            $qb->where('t.marque LIKE :searchMarque');
            $qb->setParameter('searchMarque', '%'.$value.'%');


        } else if ($valueType !== "0") { /*si le type est donné*/
            $qb->where('t.type LIKE :searchType');
            $qb->setParameter('searchType', '%'.$valueType.'%');
        
        }
       


        /*affichage par ordre alphabétique de la marque*/
        $qb->orderBy('t.marque', 'ASC');

        
        /*exécution et renvoi du résultat*/
        $query = $qb->getQuery();

        return $query->execute();
    }
}
