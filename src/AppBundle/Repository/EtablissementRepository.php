<?php

namespace AppBundle\Repository;

/**
 * EtablissementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EtablissementRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param $pays_id
     */
    public function findByEtablissement($pays_id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT eta_libelle FROM etablissement p
            WHERE p.pays_id LIKE :pays_id
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['pays_id' => $pays_id]);

        return $stmt->fetch();
    }
}