<?php

namespace DoctrineProxies\__CG__\Solr\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class SolrSearchField extends \Solr\Entity\SolrSearchField implements \Doctrine\ORM\Proxy\Proxy
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
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
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
            return ['__isInitialized__', 'id', 'solrNode', 'name', 'label', 'textFields', 'stringFields', 'facetField', 'sortField'];
        }

        return ['__isInitialized__', 'id', 'solrNode', 'name', 'label', 'textFields', 'stringFields', 'facetField', 'sortField'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (SolrSearchField $proxy) {
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
    public function setSolrNode(\Solr\Entity\SolrNode $solrNode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSolrNode', [$solrNode]);

        return parent::setSolrNode($solrNode);
    }

    /**
     * {@inheritDoc}
     */
    public function getSolrNode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSolrNode', []);

        return parent::getSolrNode();
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', [$name]);

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', []);

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function setLabel($label)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLabel', [$label]);

        return parent::setLabel($label);
    }

    /**
     * {@inheritDoc}
     */
    public function getLabel()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLabel', []);

        return parent::getLabel();
    }

    /**
     * {@inheritDoc}
     */
    public function setTextFields($textFields)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTextFields', [$textFields]);

        return parent::setTextFields($textFields);
    }

    /**
     * {@inheritDoc}
     */
    public function getTextFields()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTextFields', []);

        return parent::getTextFields();
    }

    /**
     * {@inheritDoc}
     */
    public function setStringFields($stringFields)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStringFields', [$stringFields]);

        return parent::setStringFields($stringFields);
    }

    /**
     * {@inheritDoc}
     */
    public function getStringFields()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStringFields', []);

        return parent::getStringFields();
    }

    /**
     * {@inheritDoc}
     */
    public function setFacetField($facetField)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFacetField', [$facetField]);

        return parent::setFacetField($facetField);
    }

    /**
     * {@inheritDoc}
     */
    public function getFacetField()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFacetField', []);

        return parent::getFacetField();
    }

    /**
     * {@inheritDoc}
     */
    public function setSortField($sortField)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSortField', [$sortField]);

        return parent::setSortField($sortField);
    }

    /**
     * {@inheritDoc}
     */
    public function getSortField()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSortField', []);

        return parent::getSortField();
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
