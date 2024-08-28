<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Winner;

/**
 * Winners Controller
 *
 * @property \App\Model\Table\WinnersTable $Winners
 * @method \App\Model\Entity\Winner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WinnersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $winners = $this->paginate($this->Winners);

        $this->set(compact('winners'));
    }

    /**
     * View method
     *
     * @param string|null $id Winner id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $winner = $this->Winners->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('winner'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $winner = $this->Winners->newEmptyEntity();
        if ($this->request->is('post')) {
            $user_logged = $this->request->getAttribute('identity');
            $winner = $this->Winners->patchEntity($winner, $this->request->getData());
            $winner->user_id = $user_logged['id'];

            $cnt_sapid = $this->Winners->find()->where(['sapid' => $winner->sapid])->count();
            if ($cnt_sapid == 0) {
                if ($this->Winners->save($winner)) {
                    $this->Flash->success(__('Ganhador registrado com sucesso.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Falha ao registrar ganhador. Por favor, tente novamente.'));
            } else {
                $this->Flash->error(__('Já existe ganhador cadastrado com este número de matrícula. Por favor, verifique. Não será possível salvar. '));
            }
        }
        $users = $this->Winners->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('winner', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Winner id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function edit($id = null)
    // {
    //     $winner = $this->Winners->get($id, [
    //         'contain' => [],
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $winner = $this->Winners->patchEntity($winner, $this->request->getData());
    //         if ($this->Winners->save($winner)) {
    //             $this->Flash->success(__('Ganhador atualizado com sucesso.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('Falha ao atualizar ganhador. Por favor, tente novamente.'));
    //     }
    //     $users = $this->Winners->Users->find('list', ['limit' => 200])->all();
    //     $this->set(compact('winner', 'users'));
    // }

    /**
     * Delete method
     *
     * @param string|null $id Winner id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $winner = $this->Winners->get($id);
        if ($this->Winners->delete($winner)) {
            $this->Flash->success(__('Ganhador excluído com sucesso.'));
        } else {
            $this->Flash->error(__('Falha ao excluir ganhador. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
