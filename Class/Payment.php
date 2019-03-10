<?php

class Payment implements JsonSerializable {
      protected $referencia;
      protected $description;
      protected $currency;
      protected $total;
      
      function __construct() {}
      
    function getReferencia() {
        return $this->referencia;
    }

    function getDescription() {
        return $this->description;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getCurrency() {
        return $this->currency;
    }

    function getTotal() {
        return $this->total;
    }

    function setCurrency($currency) {
        $this->currency = $currency;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    public function jsonSerialize()
    {
        return 
        [      
            'referencia' => $this->getReferencia(),
            'description' => $this->getDescription()        
        ];
    }

}
