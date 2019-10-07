<?php

namespace Carteira\Controller;

use Carteira\Form\CarteiraForm;
use Carteira\Model\Carteira;
use Carteira\Model\CarteiraTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CarteiraController extends AbstractActionController{

    private $table;
    
    public function __construct(CarteiraTable $table)
    {
        $this->table = $table;
    }

    public function indexAction(){
        return new ViewModel([
            'carteira' => $this->table->fetchAll(),
        ]);
    }

    public function addAction(){

        $form = new CarteiraForm();
        $form->get('submit')->setValue('Adicionar');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $carteira = new Carteira();

        $form->setInputFilter($carteira->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $carteira->exchangeArray($form->getData());
        $this->table->saveCarteira($carteira);
        return $this->redirect()->toRoute('carteira');
    }

    public function editAction(){

        $id = (int) $this->params()->fromRoute('id', 0);


        if(0 === $id) {
            return $this->redirect()->toRoute('carteira', ['action' => 'add']);
        }

        try {
            $carteira = $this->table->getCarteira($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('carteira', ['action' => 'index']);
        }

        $form = new CarteiraForm();
        $form->bind($carteira);
        $form->get('submit')->setAttribute('value', 'Editar');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if(! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($carteira->getInputFilter());
        $form->setData($request->getPost());

        if(! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveCarteira($carteira);

        return $this->redirect()->toRoute('carteira', ['action' => 'index']);

    }

    public function deleteAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('carteira');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');

            if ($del === 'Sim') {
                $id = (int) $request->getPost('id');
                $this->table->delete($id);
            }

            return $this->redirect()->toRoute('carteira');
        }

        $carteira = $this->table->getCarteira($id);

        return compact('id', 'carteira');

    }
}