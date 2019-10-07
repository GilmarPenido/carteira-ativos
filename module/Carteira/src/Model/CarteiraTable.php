<?php

namespace Carteira\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;

class CarteiraTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;        
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getCarteira($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if(! $row) {
            throw new RuntimeException(sprintf(
                "Não foi encontrada carteia com id %d",
                $id
            ));
        }

        return $row;
    }

    public function saveCarteira(Carteira $carteira)
    {
        $data = [
            'empresa' => $carteira->empresa,
            'codigo' => $carteira->codigo,
            'quantidade' => $carteira->quantidade,
        ];

        $id = (int) $carteira->id;

        if($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getCarteira($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Não é possível atualizar carteira com id %d',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function delete($id)
    {
        $this->tableGateway->delete(['id' => (int)$id]);
    }
}