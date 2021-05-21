<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Activiteit
 *
 * @ORM\Table(name="activiteiten")
 * @ORM\Entity(repositoryClass="App\Repository\ActiviteitRepository")
 */
class Activiteit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date")
     * @Assert\NotBlank(message="vul een datum in")
     *
     */
    private $datum;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tijd", type="time")
     * @Assert\NotBlank(message="vul een tijd in")
     *
     */
    private $tijd;

    /**
     * @ORM\ManyToOne(targetEntity="Soortactiviteit", inversedBy="activiteiten")
     * @ORM\JoinColumn(name="soort_id",referencedColumnName="id")
     *
     */

    private $soort;

    /**
     * Many Activiteiten have Many Users.
     * @ORM\ManyToMany(targetEntity="User", mappedBy="activiteiten")
     */

    private $users;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_deelnemers;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Activiteit
     */
    public function setDatum($datum)
    {

        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set tijd
     *
     * @param \DateTime $tijd
     *
     * @return Activiteit
     */
    public function setTijd($tijd)
    {
        $this->tijd = $tijd;

        return $this;
    }

    /**
     * Get tijd
     *
     * @return \DateTime
     */
    public function getTijd()
    {
        return $this->tijd;
    }

    public function getSoort()
    {
        return $this->soort;
    }

    public function setSoort($soort)
    {
        $this->soort=$soort;
    }

    public function getMaxDeelnemers(): ?int
    {
        return $this->max_deelnemers;
    }

    public function setMaxDeelnemers(int $max_deelnemers): self
    {
        $this->max_deelnemers = $max_deelnemers;

        return $this;
    }
}

