<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Awards Controller
 *
 * @property \App\Model\Table\AwardsTable $Awards
 * @method \App\Model\Entity\Award[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AwardsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($sweepstake_id)
    {
        $awards = $this->paginate($this->Awards->find('all')->contain(['Sweepstakes'])->where(['sweepstake_id' => $sweepstake_id]));
        $sweepstake = $this->Awards->Sweepstakes->find()->where(['Sweepstakes.id' => $sweepstake_id])->first();
        $this->set(compact('awards', 'sweepstake_id', 'sweepstake'));
    }

    /**
     * View method
     *
     * @param string|null $id Award id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $award = $this->Awards->get($id, [
            'contain' => ['Sweepstakes'],
        ]);

        $this->set(compact('award'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($sweepstake_id)
    {
        $award = $this->Awards->newEmptyEntity();
        if ($this->request->is('post')) {
            $award = $this->Awards->patchEntity($award, $this->request->getData());
            $award->balance = $award->quantity;
            if ($this->Awards->save($award)) {
                $this->Flash->success(__('Prêmio salvo com sucesso.'));

                return $this->redirect(['action' => 'index', $sweepstake_id]);
            }
            $this->Flash->error(__('Falha ao salvar prêmio. Por favor, tente novamente.'));
        }
        $sweepstakes = $this->Awards->Sweepstakes->find('list', ['limit' => 200])->all();
        $this->set(compact('award', 'sweepstakes', 'sweepstake_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Award id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $sweepstake_id)
    {
        $award = $this->Awards->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $award = $this->Awards->patchEntity($award, $this->request->getData());
            if ($this->Awards->save($award)) {
                $this->Flash->success(__('Prêmio salvo com sucesso.'));

                return $this->redirect(['action' => 'index', $sweepstake_id]);
            }
            $this->Flash->error(__('Falha ao salvar prêmio. Por favor, tente novamente.'));
        }
        $sweepstakes = $this->Awards->Sweepstakes->find('list', ['limit' => 200])->all();
        $this->set(compact('award', 'sweepstakes', 'sweepstake_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Award id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $sweepstake_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $award = $this->Awards->get($id);
        if ($this->Awards->delete($award)) {
            $this->Flash->success(__('prêmio removido.'));
        } else {
            $this->Flash->error(__('Falha ao remover prêmio. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index', $sweepstake_id]);
    }
}
