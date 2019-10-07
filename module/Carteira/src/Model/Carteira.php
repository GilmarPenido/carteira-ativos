<?php

namespace Carteira\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class Carteira
{
    private $inputFilter;

    public $id;
    public $empresa;
    public $codigo;
    public $quantidade;

    public function exchangeArray(array $data){

        $this->id = empty($data['id']) ? null : $data['id'];
        $this->empresa = empty($data['empresa']) ? null : $data['empresa'];
        $this->codigo = empty($data['codigo']) ? null : $data['codigo'];
        $this->quantidade = empty($data['quantidade']) ? null : $data['quantidade'];

    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'empresa' => $this->empresa,
            'codigo' => $this->codigo,
            'quantidade' => $this->quantidade,
        ];
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'empresa',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'codigo',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
            ],
        ]);


        $inputFilter->add([
            'name' => 'quantidade',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $this->inputFilter = $inputFilter;

        return $this->inputFilter;

    }
}