<?php

    namespace Ant\RecipeBundle\Repository;
    
    use Doctrine\ORM\EntityRepository;
    
    
    class RecipeRepository extends EntityRepository{
        public function findOfertaDelDia($receta){
            
        }
        
        public function findRecipe($ids){
            $queryBuilder = $this->_em->createQueryBuilder( );
            
            $queryBuilder->select('r')->from('RecipeBundle:Recipe', 'r')->where('r.id IN (:ids)')
                   ->setParameter('ids', $ids);
            
            return $queryBuilder->getQuery();
        }
        
    }

