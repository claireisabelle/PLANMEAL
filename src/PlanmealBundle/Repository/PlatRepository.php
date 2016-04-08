<?php

namespace PlanmealBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


/**
 * PlatRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlatRepository extends \Doctrine\ORM\EntityRepository
{
	
	public function getPlats()
	{
		$qb = $this->createQueryBuilder('p')
			->orderBy('p.nbreUtilisation', 'DESC')
			->addOrderBy('p.dateUtilisation', 'DESC')
			->getQuery()
		;

		return $qb->getResult();
	}

	public function getSuggestionsPrincipal()
	{
		$qb = $this->createQueryBuilder('p')
		->where('p.categorie = :categorie')
		->setParameter('categorie', 'Principal')
		->orderBy('p.dateUtilisation', 'ASC')
		->addOrderBy('p.nbreUtilisation', 'ASC')
		->setMaxResults(5)
		->getQuery()
		;

		return $qb->getResult();
	}

	public function getSuggestionsEntree()
	{
		$qb = $this->createQueryBuilder('p')
		->where('p.categorie = :categorie')
		->setParameter('categorie', 'Entrée')
		->orderBy('p.dateUtilisation', 'ASC')
		->addOrderBy('p.nbreUtilisation', 'ASC')
		->setMaxResults(5)
		->getQuery()
		;

		return $qb->getResult();
	}


}
