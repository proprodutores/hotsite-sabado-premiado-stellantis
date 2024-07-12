<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Sweepstakes Controller
 *
 * @property \App\Model\Table\SweepstakesTable $Sweepstakes
 * @method \App\Model\Entity\Sweepstake[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SweepstakesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $sweepstakes = $this->paginate($this->Sweepstakes);

        $this->set(compact('sweepstakes'));
    }

    /**
     * View method
     *
     * @param string|null $id Sweepstake id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sweepstake = $this->Sweepstakes->get($id, [
            'contain' => ['Awards'],
        ]);

        $this->set(compact('sweepstake'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sweepstake = $this->Sweepstakes->newEmptyEntity();
        if ($this->request->is('post')) {
            $sweepstake = $this->Sweepstakes->patchEntity($sweepstake, $this->request->getData());
            if ($this->Sweepstakes->save($sweepstake)) {
                $this->Flash->success(__('The sweepstake has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sweepstake could not be saved. Please, try again.'));
        }
        $this->set(compact('sweepstake'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sweepstake id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sweepstake = $this->Sweepstakes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sweepstake = $this->Sweepstakes->patchEntity($sweepstake, $this->request->getData());
            if ($this->Sweepstakes->save($sweepstake)) {
                $this->Flash->success(__('The sweepstake has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sweepstake could not be saved. Please, try again.'));
        }
        $this->set(compact('sweepstake'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sweepstake id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sweepstake = $this->Sweepstakes->get($id);
        if ($this->Sweepstakes->delete($sweepstake)) {
            $this->Flash->success(__('The sweepstake has been deleted.'));
        } else {
            $this->Flash->error(__('The sweepstake could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
