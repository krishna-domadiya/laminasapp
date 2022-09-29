<?php

namespace Beer\Model;

use Beer\Model\Beer;
use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;
class BeerTable {
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAllRecords() {
        return $this->tableGateway->select();
    }

    public function getBeer($id) {
        $id = (int) $id;
        $formset = $this->tableGateway->select(['id' => $id]);
        $row = $formset->current();

        if(!$row) {
            throw new RuntimeException(
                sprintf("Couldn't find the record with id %d", $id)
            );
        }

        return $row;
    }

    public function saveBeer(Beer $beer) {
        $data = [
            'name' => $beer->name,
            'descript' => $beer->descript
        ];

        $id = (int) $beer->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }
        try {
            $this->getBeer($id);
        } 
        catch (RuntimeException $e) {
            throw new RuntimeException(
                sprintf("Can not update the record with id %d", $id)
            );
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteBeer($id) {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}