<?php


    namespace Ant\RecipeBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;

    
    /**
    * @ORM\Entity
    */
    class Ingredient{
        
        /** 
         * @ORM\Id
         * @ORM\Column(name="id", type="integer") 
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;
        
        /**
        * @var string
        *
        * @ORM\Column(name="name", type="string", length=255)
        */
        protected $name;
        
        /**
        * @var \DateTime
        *
        * @ORM\Column(name="created_at", type="datetime")
        */
        protected $createdAt;
        
        

        /** @ORM\OneToMany(targetEntity="Ant\RecipeBundle\Entity\RecipeIngredient",cascade={"remove"}, mappedBy="ingredient") */
        private $recipeIngredients;

        
        function getId() {
            return $this->id;
        }

        function getName() {
            return $this->name;
        }

        function getCreatedAt() {
            return $this->createdAt;
        }

        function getRecipeIngredients() {
            return $this->recipeIngredients;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setName($name) {
            $this->name = $name;
        }

        function setCreatedAt(\DateTime $createdAt) {
            $this->createdAt = $createdAt;
        }

        function setRecipeIngredients($recipeIngredients) {
            $this->recipeIngredients = $recipeIngredients;
        }

        public function __toString(){
            return $this->getName();
        }
    }


