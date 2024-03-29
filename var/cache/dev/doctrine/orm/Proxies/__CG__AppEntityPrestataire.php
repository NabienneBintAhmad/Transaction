<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Prestataire extends \App\Entity\Prestataire implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'nom', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'prenom', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'nomEntreprise', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'adresse', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'contact', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'cni', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'email', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'matricule', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'compte', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'admin', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'comptes', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'ninea', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'userPrestataires', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'users'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'id', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'nom', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'prenom', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'nomEntreprise', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'adresse', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'contact', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'cni', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'email', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'matricule', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'compte', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'admin', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'comptes', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'ninea', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'userPrestataires', '' . "\0" . 'App\\Entity\\Prestataire' . "\0" . 'users'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Prestataire $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getNom(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNom', []);

        return parent::getNom();
    }

    /**
     * {@inheritDoc}
     */
    public function setNom(string $nom): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNom', [$nom]);

        return parent::setNom($nom);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrenom(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrenom', []);

        return parent::getPrenom();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrenom(string $prenom): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrenom', [$prenom]);

        return parent::setPrenom($prenom);
    }

    /**
     * {@inheritDoc}
     */
    public function getNomEntreprise(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNomEntreprise', []);

        return parent::getNomEntreprise();
    }

    /**
     * {@inheritDoc}
     */
    public function setNomEntreprise(string $nomEntreprise): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNomEntreprise', [$nomEntreprise]);

        return parent::setNomEntreprise($nomEntreprise);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdresse(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdresse', []);

        return parent::getAdresse();
    }

    /**
     * {@inheritDoc}
     */
    public function setAdresse(string $adresse): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAdresse', [$adresse]);

        return parent::setAdresse($adresse);
    }

    /**
     * {@inheritDoc}
     */
    public function getContact(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContact', []);

        return parent::getContact();
    }

    /**
     * {@inheritDoc}
     */
    public function setContact(int $contact): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContact', [$contact]);

        return parent::setContact($contact);
    }

    /**
     * {@inheritDoc}
     */
    public function getCni(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCni', []);

        return parent::getCni();
    }

    /**
     * {@inheritDoc}
     */
    public function setCni(int $cni): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCni', [$cni]);

        return parent::setCni($cni);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail(string $email): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getMatricule(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMatricule', []);

        return parent::getMatricule();
    }

    /**
     * {@inheritDoc}
     */
    public function setMatricule(string $matricule): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMatricule', [$matricule]);

        return parent::setMatricule($matricule);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompte(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompte', []);

        return parent::getCompte();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompte(int $compte): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompte', [$compte]);

        return parent::setCompte($compte);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdmin(): ?\App\Entity\Admin
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdmin', []);

        return parent::getAdmin();
    }

    /**
     * {@inheritDoc}
     */
    public function setAdmin(?\App\Entity\Admin $admin): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAdmin', [$admin]);

        return parent::setAdmin($admin);
    }

    /**
     * {@inheritDoc}
     */
    public function getComptes(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getComptes', []);

        return parent::getComptes();
    }

    /**
     * {@inheritDoc}
     */
    public function addCompte(\App\Entity\Compte $compte): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCompte', [$compte]);

        return parent::addCompte($compte);
    }

    /**
     * {@inheritDoc}
     */
    public function removeCompte(\App\Entity\Compte $compte): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCompte', [$compte]);

        return parent::removeCompte($compte);
    }

    /**
     * {@inheritDoc}
     */
    public function getNinea(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNinea', []);

        return parent::getNinea();
    }

    /**
     * {@inheritDoc}
     */
    public function setNinea(string $ninea): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNinea', [$ninea]);

        return parent::setNinea($ninea);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserPrestataires(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserPrestataires', []);

        return parent::getUserPrestataires();
    }

    /**
     * {@inheritDoc}
     */
    public function addUserPrestataire(\App\Entity\UserPrestataire $userPrestataire): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addUserPrestataire', [$userPrestataire]);

        return parent::addUserPrestataire($userPrestataire);
    }

    /**
     * {@inheritDoc}
     */
    public function removeUserPrestataire(\App\Entity\UserPrestataire $userPrestataire): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeUserPrestataire', [$userPrestataire]);

        return parent::removeUserPrestataire($userPrestataire);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsers(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsers', []);

        return parent::getUsers();
    }

    /**
     * {@inheritDoc}
     */
    public function addUser(\App\Entity\User $user): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addUser', [$user]);

        return parent::addUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function removeUser(\App\Entity\User $user): \App\Entity\Prestataire
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeUser', [$user]);

        return parent::removeUser($user);
    }

}
