<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Cake\View\JsonView;

/**
 * Play Controller
 *
 * @property \App\Model\Table\PlayTable $Play
 * @method \App\Model\Entity\Play[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlayController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Awards', 'Users'],
        ];
        $play = $this->paginate($this->Play);

        $this->set(compact('play'));
    }

    /**
     * View method
     *
     * @param string|null $id Play id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $play = $this->Play->get($id, [
            'contain' => ['Awards', 'Users'],
        ]);

        $this->set(compact('play'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $play = $this->Play->newEmptyEntity();
        if ($this->request->is('post')) {
            $play = $this->Play->patchEntity($play, $this->request->getData());
            if ($this->Play->save($play)) {
                $this->Flash->success(__('The play has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The play could not be saved. Please, try again.'));
        }
        $awards = $this->Play->Awards->find('list', ['limit' => 200])->all();
        $users = $this->Play->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('play', 'awards', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Play id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $play = $this->Play->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $play = $this->Play->patchEntity($play, $this->request->getData());
            if ($this->Play->save($play)) {
                $this->Flash->success(__('The play has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The play could not be saved. Please, try again.'));
        }
        $awards = $this->Play->Awards->find('list', ['limit' => 200])->all();
        $users = $this->Play->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('play', 'awards', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Play id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $play = $this->Play->get($id);
        if ($this->Play->delete($play)) {
            $this->Flash->success(__('The play has been deleted.'));
        } else {
            $this->Flash->error(__('The play could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function game()
    {
        $now = date('Y-m-d H:i:s');

        $sweepstake = $this->fetchTable('Sweepstakes')->find()->where(['date_start <= ' => $now, 'date_end >= ' => $now, 'active' => true])->first();
        if ($sweepstake) {
            $spaces = $sweepstake->spaces;
            $awards = $this->fetchTable('Awards')->find()->select(['name', 'spaces', 'balance', 'image'])->where(['sweepstake_id' => $sweepstake->id])->order(['id'])->toList();

            $awards_balance = $this->fetchTable('Awards')->find()->select(['name', 'spaces', 'image'])->where(['sweepstake_id' => $sweepstake->id, 'balance >' => 0])->order(['id'])->toList();

            $award = null;
            $selected = rand(1, $spaces);
            if ($selected <= count($awards_balance)) {
                $award = $selected - 1;
            }

            $awards = json_encode($awards);

            $this->set(compact('spaces', 'awards', 'selected', 'award'));
        }
    }

    public function getAwards()
    {
        $now = date('Y-m-d H:i:s');

        $awards = $this->fetchTable('Awards')->find()
            ->contain(['Sweepstakes'])
            ->select(['Sweepstakes.spaces', 'Awards.id', 'Awards.name', 'Awards.spaces', 'Awards.balance', 'Awards.image'])
            ->where([
                'Sweepstakes.date_start <=' => $now,
                'Sweepstakes.date_end >=' => $now,
                'Sweepstakes.active' => true
            ])
            ->order(['Awards.id'])
            ->toList();

        if ($awards) {
            return $this->response->withStringBody(json_encode($awards));
        }

        return $this->response->withStringBody(json_encode($awards));
    }

    public function getAward()
    {
        $now = date('Y-m-d H:i:s');

        $awards_balance = $this->fetchTable('Awards')->find()->contain(['Sweepstakes'])
            ->select(['Sweepstakes.spaces', 'Awards.id', 'Awards.name', 'Awards.spaces', 'Awards.balance', 'Awards.image'])
            ->where(['Sweepstakes.date_start <= ' => $now, 'Sweepstakes.date_end >= ' => $now, 'Sweepstakes.active' => true, 'balance >' => 0])
            ->order(['Awards.id'])->toList();

        if ($awards_balance) {
            $spaces = $awards_balance[0]->sweepstake->spaces;

            $award = null;
            $selected = rand(1, ($spaces * 2));
            if ($selected <= count($awards_balance)) {
                $award = $awards_balance[$selected - 1]->id;
            }

            return $this->response->withStringBody(json_encode($award));
        }

        return $this->response->withStringBody("");
    }

    public function registerAward()
    {
        if ($this->request->is('post')) {
            $user_id = $this->request->getData('user_id');
            $award_id = $this->request->getData('award_id');

            if ($award_id == null) {
                $play = $this->Play->newEmptyEntity();
                $play->user_id = $user_id;

                if ($this->Play->save($play)) {
                    return $this->response->withStringBody("OK");
                } else {
                    return $this->response->withStringBody("");
                }
            } else {
                $award = $this->fetchTable('Awards')->find()->where(['id' => $award_id])->first();

                if ($award && $award->balance > 0) {
                    $award->balance--;
                    if ($this->fetchTable('Awards')->save($award)) {
                        $play = $this->Play->newEmptyEntity();
                        $play->user_id = $user_id;
                        $play->award_id = $award_id;

                        if ($this->Play->save($play)) {
                            return $this->response->withStringBody("OK");
                        } else {
                            return $this->response->withStringBody("");
                        }
                    }
                } else {
                    return $this->response->withStringBody("");
                }
            }
        } else {
            return $this->response->withStringBody("");
        }
    }
}
