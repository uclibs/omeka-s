<?php

namespace DoctrineProxies\__CG__\Datavis\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class DatavisVis extends \Datavis\Entity\DatavisVis implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
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
            return ['__isInitialized__', 'id', 'owner', 'site', 'created', 'modified', 'datasetModified', 'datasetType', 'diagramType', 'datasetData', 'diagramData', 'dataset', 'title', 'description', 'query'];
        }

        return ['__isInitialized__', 'id', 'owner', 'site', 'created', 'modified', 'datasetModified', 'datasetType', 'diagramType', 'datasetData', 'diagramData', 'dataset', 'title', 'description', 'query'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (DatavisVis $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
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
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
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
    public function setOwner(\Omeka\Entity\User $owner = NULL): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOwner', [$owner]);

        parent::setOwner($owner);
    }

    /**
     * {@inheritDoc}
     */
    public function getOwner(): ?\Omeka\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOwner', []);

        return parent::getOwner();
    }

    /**
     * {@inheritDoc}
     */
    public function setSite(\Omeka\Entity\Site $site): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSite', [$site]);

        parent::setSite($site);
    }

    /**
     * {@inheritDoc}
     */
    public function getSite(): \Omeka\Entity\Site
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSite', []);

        return parent::getSite();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreated(\DateTime $created): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreated', [$created]);

        parent::setCreated($created);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreated(): \DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreated', []);

        return parent::getCreated();
    }

    /**
     * {@inheritDoc}
     */
    public function setModified(\DateTime $modified): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setModified', [$modified]);

        parent::setModified($modified);
    }

    /**
     * {@inheritDoc}
     */
    public function getModified(): ?\DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getModified', []);

        return parent::getModified();
    }

    /**
     * {@inheritDoc}
     */
    public function setDatasetModified(\DateTime $datasetModified): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDatasetModified', [$datasetModified]);

        parent::setDatasetModified($datasetModified);
    }

    /**
     * {@inheritDoc}
     */
    public function getDatasetModified(): ?\DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDatasetModified', []);

        return parent::getDatasetModified();
    }

    /**
     * {@inheritDoc}
     */
    public function setDatasetType(string $datasetType): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDatasetType', [$datasetType]);

        parent::setDatasetType($datasetType);
    }

    /**
     * {@inheritDoc}
     */
    public function getDatasetType(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDatasetType', []);

        return parent::getDatasetType();
    }

    /**
     * {@inheritDoc}
     */
    public function setDiagramType(?string $diagramType): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDiagramType', [$diagramType]);

        parent::setDiagramType($diagramType);
    }

    /**
     * {@inheritDoc}
     */
    public function getDiagramType(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDiagramType', []);

        return parent::getDiagramType();
    }

    /**
     * {@inheritDoc}
     */
    public function setDatasetData(array $datasetData): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDatasetData', [$datasetData]);

        parent::setDatasetData($datasetData);
    }

    /**
     * {@inheritDoc}
     */
    public function getDatasetData(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDatasetData', []);

        return parent::getDatasetData();
    }

    /**
     * {@inheritDoc}
     */
    public function setDiagramData(array $diagramData): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDiagramData', [$diagramData]);

        parent::setDiagramData($diagramData);
    }

    /**
     * {@inheritDoc}
     */
    public function getDiagramData(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDiagramData', []);

        return parent::getDiagramData();
    }

    /**
     * {@inheritDoc}
     */
    public function setDataset(?array $dataset): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDataset', [$dataset]);

        parent::setDataset($dataset);
    }

    /**
     * {@inheritDoc}
     */
    public function getDataset(): ?array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDataset', []);

        return parent::getDataset();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle(string $title): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitle', [$title]);

        parent::setTitle($title);
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitle', []);

        return parent::getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription(?string $description): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', [$description]);

        parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', []);

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setQuery(string $query): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setQuery', [$query]);

        parent::setQuery($query);
    }

    /**
     * {@inheritDoc}
     */
    public function getQuery(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getQuery', []);

        return parent::getQuery();
    }

    /**
     * {@inheritDoc}
     */
    public function prePersist(\Doctrine\ORM\Event\LifecycleEventArgs $eventArgs): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'prePersist', [$eventArgs]);

        parent::prePersist($eventArgs);
    }

    /**
     * {@inheritDoc}
     */
    public function getResourceId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResourceId', []);

        return parent::getResourceId();
    }

}