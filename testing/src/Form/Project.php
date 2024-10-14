<?php
namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;

class Project
{
   /**
    * @Assert\NotBlank
    */
    public ?string $name = '';

    /**
    * @Assert\NotBlank
    */
    public ?string $description = '';

   /**
    * @Assert\NotBlank
    * @Assert\Type("\DateTime")
    */
    public ?\DateTime $created_at = null;

    /**
    * @Assert\NotBlank
    * @Assert\Type("\DateTime")
    */
    public ?\DateTime $updated_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }
}