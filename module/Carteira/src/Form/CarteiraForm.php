<?php

namespace Carteira\Form;

use Zend\Form\Form;

class CarteiraForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('carteira');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'empresa',
            'type' => 'text',
            'options' => [
                'label' => 'Empresa'
            ]
        ]);

        $this->add([
            'name' => 'codigo',
            'type' => 'text',
            'options' => [
                'label' => 'Código'
            ]
        ]);

        $this->add([
            'name' => 'quantidade',
            'type' => 'number',
            'options' => [
                'label' => 'Quantidade'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id' => 'submitbutton',
            ]
        ]);

    }
}