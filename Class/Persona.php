<?php 

class Persona implements JsonSerializable 
{    
    protected $person_id;
    protected $documentType;
    protected $document;
    protected $name;
    protected $surname;
    protected $country = 'CO';
    protected $email;
    protected $address;
    protected $city;

    public function __construct() {}

    function getPerson_id() {
        return $this->person_id;
    }

    function getDocumentType() {
        return $this->documentType;
    }

    function getDocument() {
        return $this->document;
    }

    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function getCountry() {
        return $this->country;
    }

    function getEmail() {
        return $this->email;
    }

    function getAddress() {
        return $this->address;
    }

    function setPerson_id($person_id) {
        $this->person_id = $person_id;
    }

    function setDocumentType($documentType) {
        $this->documentType = $documentType;
    }

    function setDocument($document) {
        $this->document = $document;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function getCity() {
        return $this->city;
    }

    function setCity($city) {
        $this->city = $city;
    }

    public function jsonSerialize() 
    {
        return 
        [      
            'document' => $this->getDocument(),
            'documentType' => $this->getDocumentType(),            
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail()           
        ];
    }

}
