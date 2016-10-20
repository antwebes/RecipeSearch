<?php

    namespace Ant\RecipeBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

    
    /**
    * @ORM\Entity
     * @UniqueEntity(
     *    fields={"ingredient", "recipe"},
     *    errorPath="recipe",
     *    message="Este ingrediente ya está en esta receta"
     * )
    */
    class RecipeIngredient{
        
        
        /** 
         * @ORM\Id
         * @ORM\Column(name="id", type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;
        
        /**
        * @var string
        *
        * @ORM\Column(name="quantity", type="string", length=255)
        */
        protected $quantity;
        
        /**
        * @var boolean
        *
        * @ORM\Column(name="mandatory", type="boolean", nullable=false)
        */
        protected $mandatory;
        
        /** 
         * @var int
         * @ORM\ManyToOne(targetEntity="Ant\RecipeBundle\Entity\Ingredient", inversedBy="recipeIngredients") 
         * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id", nullable=true) 
         */
        private $ingredient;
        
        /** 
         * @var int
         * @ORM\ManyToOne(targetEntity="Ant\RecipeBundle\Entity\Recipe", inversedBy="recipeIngredients") 
         * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id", nullable=false) 
         */
        private $recipe;
        
        function getId() {
            return $this->id;
        }
        
        function getQuantity() {
            return $this->quantity;
        }

        function getMandatory() {
            return $this->mandatory;
        }

        function getIngredient() {
            return $this->ingredient;
        }

        function getRecipe() {
            return $this->recipe;
        }
        
        function setId($id){
            $this->id = $id;
        }

        function setQuantity($quantity) {
            $this->quantity = $quantity;
        }

        function setMandatory($mandatory) {
            $this->mandatory = $mandatory;
        }

        function setIngredient($ingredient) {
            $this->ingredient = $ingredient;
        }

        function setRecipe($recipe) {
            $this->recipe = $recipe;
        }

        
    }


