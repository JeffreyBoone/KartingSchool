<?php
// src/App/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
* @ORM\Table(name="app_users")
* @ORM\Entity(repositoryClass="App\Repository\UserRepository")
*/
class User implements UserInterface, \Serializable
{
/**
* @ORM\Column(type="integer")
* @ORM\Id
* @ORM\GeneratedValue(strategy="AUTO")
*/
private $id;

/**
* @ORM\Column(type="string", length=25, unique=true)
* @Assert\NotBlank(message="vul gebruikersnaam in")
*/
private $username;

/**
* @ORM\Column(type="string", length=64)
*/
private $password;

/**
* @ORM\Column(type="string", length=60, unique=false)
 *  @Assert\Email(
 *    message = "The email '{{ value }}' is geen geldig email adres")
 * @Assert\NotBlank(message="vul emailadres in")
*/
private $email;

/**
 * @Assert\Length(max=4096)
 * @Assert\NotBlank(message="vul wachtwoord in")
 */
private $plainPassword;

/**
 * @ORM\Column(type="json_array")
 */
private $roles = array();

/**
 * @ORM\Column(type="string", length=10)
 * @Assert\NotBlank(message="vul voorletters in")
 */
private $voorletters;

/**
 * @ORM\Column(type="string", length=10, nullable=true)
 */
private $tussenvoegsel;

/**
 * @ORM\Column(type="string", length=25)
 * @Assert\NotBlank(message="vul achternaam in")
 */
private $achternaam;

/**
 * @ORM\Column(type="string", length=25)
 * @Assert\NotBlank(message="vul adres in")
 *
 */
private $adres;

/**
 * @ORM\Column(type="string", length=7)
 * @Assert\NotBlank(message="vul postcode in")
 */
private $postcode;

/**
 * @ORM\Column(type="string", length=20)
 * @Assert\NotBlank(message="vul woonplaats in")
 */
private $woonplaats;
/**
 * @ORM\Column(type="string", length=15)
 *  @Assert\NotBlank(message="vul telfoonnummer in")
 */
private $telefoon;


public function getId()
{
    return $this->id;
}

function getNaam()
{
    return $this->voorletters." ".$this->tussenvoegsel." ".$this->achternaam;
}
/**
 * @return mixed
 */
public function getVoorletters()
{
    return $this->voorletters;
}

/**
 * @param mixed $voorletters
 */
public function setVoorletters($voorletters)
{
    $this->voorletters = $voorletters;
}

/**
 * @return mixed
 */
public function getTussenvoegsel()
{
    return $this->tussenvoegsel;
}

/**
 * @param mixed $tussenvoegsel
 */
public function setTussenvoegsel($tussenvoegsel)
{
    $this->tussenvoegsel = $tussenvoegsel;
}

/**
 * @return mixed
 */
public function getAchternaam()
{
    return $this->achternaam;
}

/**
 * @param mixed $achternaam
 */
public function setAchternaam($achternaam)
{
    $this->achternaam = $achternaam;
}

/**
 * @return mixed
 */
public function getAdres()
{
    return $this->adres;
}

/**
 * @param mixed $adres
 */
public function setAdres($adres)
{
    $this->adres = $adres;
}

/**
 * @return mixed
 */
public function getPostcode()
{
    return $this->postcode;
}

/**
 * @param mixed $postcode
 */
public function setPostcode($postcode)
{
    $this->postcode = $postcode;
}

/**
 * @return mixed
 */
public function getWoonplaats()
{
    return $this->woonplaats;
}

/**
 * @param mixed $woonplaats
 */
public function setWoonplaats($woonplaats)
{
    $this->woonplaats = $woonplaats;
}

/**
 * @return mixed
 */
public function getTelefoon()
{
    return $this->telefoon;
}

/**
 * @param mixed $telefoon
 */
public function setTelefoon($telefoon)
{
    $this->telefoon = $telefoon;
}


/**
 * Many Users have Many Activities.
 * @ORM\ManyToMany(targetEntity="Activiteit", inversedBy="users")
 * @ORM\JoinTable(name="deelnames")
 */
private $activiteiten;

public function __construct()
{
    $this->activiteiten = new \Doctrine\Common\Collections\ArrayCollection();
    $this->isActive = true;
}

public function addActiviteit(Activiteit $a)
{
    if ($this->activiteiten->contains($a)) {

        return;
    }

    $this->activiteiten->add($a);

}

public function removeActiviteit(Activiteit $a)
{
    if (!$this->activiteiten->contains($a)) {
        return;
    }
    $this->activiteiten->removeElement($a);
}
public function getEmail()
{
    return $this->email;
}

public function setEmail($email)
{
    $this->email = $email;
}

public function getUsername()
{
    return $this->username;
}

public function setUsername($username)
{
    $this->username = $username;
}

public function getPassword()
{
    return $this->password;
}

public function setPassword($password)
{
    $this->password = $password;
}

public function getPlainPassword()
{
    return $this->plainPassword;
}

public function setPlainPassword($password)
{
    $this->plainPassword = $password;
}

public function getSalt()
{
    // you *may* need a real salt depending on your encoder
    // see section on salt below
    return null;
}

public function getRoles()
{
    $roles = $this->roles;
    //$roles[] = 'ROLE_USER';

    return array_unique($roles);
}
public function setRoles(array $roles)
{
    $this->roles = $roles;

    // allows for chaining
    return $this;
}

public function eraseCredentials()
{
}

/** @see \Serializable::serialize() */
public function serialize()
{
return serialize(array(
$this->id,
$this->username,
$this->password,
// see section on salt below
// $this->salt,
));
}

/** @see \Serializable::unserialize() */
public function unserialize($serialized)
{
list (
$this->id,
$this->username,
$this->password,
// see section on salt below
// $this->salt
) = unserialize($serialized);
}
}