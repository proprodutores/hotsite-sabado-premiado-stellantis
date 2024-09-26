<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
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
        $summary = "";
        $sweepstake_name = "";

        if ($this->request->is('get')) {
            $sweepstake_id = $this->request->getQuery('sweepstake_id');
            $award = $this->request->getQuery('award');
            $user_id = $this->request->getQuery('user_id');
            $start_date = $this->request->getQuery('start_date');
            $end_date = $this->request->getQuery('end_date');

            $query = $this->Play->find()
                    ->contain(['Awards' => ['Sweepstakes'], 'Users']);
                if ($sweepstake_id) {
                    $sweepstake = $this->fetchTable('Sweepstakes')->find()->where(['id' => $sweepstake_id])->first();
                    $sweepstake_name = $sweepstake->description;

                    $query->where(['Play.created >= ' => $sweepstake->date_start]);
                    $query->where(['Play.created <= ' => $query->func()->dateAdd("'".$sweepstake->date_end->format("Y-m-d H:i")."'", 1, "MINUTE")]);

                    $connection = ConnectionManager::get('default');
                    $query_summary = "SELECT u.name, 
                            (SELECT count(*) FROM play p1 WHERE user_id = u.id AND created >= '".$sweepstake->date_start->format("Y-m-d H:i")."' AND created <= DATE_ADD('".$sweepstake->date_end->format("Y-m-d H:i")."', INTERVAL 1 MINUTE)) as val1,
                            (SELECT count(*) FROM play p1 WHERE user_id = u.id AND award_id IS NOT NULL && created >= '".$sweepstake->date_start->format("Y-m-d H:i")."' AND created <= DATE_ADD('".$sweepstake->date_end->format("Y-m-d H:i")."', INTERVAL 1 MINUTE)) as val2
                            FROM play p
                            INNER JOIN users u ON u.id = p.user_id
                            WHERE p.created >= '".$sweepstake->date_start->format("Y-m-d H:i")."' AND p.created <= DATE_ADD('".$sweepstake->date_end->format("Y-m-d H:i")."', INTERVAL 1 MINUTE)
                            GROUP BY u.name";
                    $statement = $connection->prepare($query_summary);
                    $statement->execute();
                    $count = $statement->columnCount();
                    if ($count > 0)
                        $summary = $statement->fetchAll('assoc');

                }
                if ($user_id) {
                    $query->where(['user_id ' => $user_id]);
                }
                if ($award) {
                    $query->where(['award_id IS NOT ' => null]);
                }
                if ($start_date) {
                    $query->where(['Play.created >= ' => $start_date]);
                }
                if ($end_date) {
                    $query->where(['Play.created <= ' => $end_date]);
                }
                $query->order(['Play.id']);
                $play = $this->paginate($query);
        }
        else{
            $this->paginate = [
                'contain' => ['Awards' => ['Sweepstakes'], 'Users'],
                'order' => ['Play.id']
            ];
            $play = $this->paginate($this->Play);

        }

        

        $users = $this->Play->Users->find('list')->where(['type' => 'Restaurante' ]);
        $sweepstakes = $this->fetchTable('Sweepstakes')->find('list')->all();

        $this->set(compact('play', 'users', 'sweepstakes', 'summary', 'sweepstake_name'));
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
            ->select(['Sweepstakes.spaces', 'Awards.id', 'Awards.name', 'Awards.description', 'Awards.spaces', 'Awards.balance', 'Awards.image'])
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
            ->select(['Sweepstakes.spaces', 'Sweepstakes.difficulty', 'Awards.id', 'Awards.name', 'Awards.description', 'Awards.spaces', 'Awards.balance', 'Awards.image'])
            ->where(['Sweepstakes.date_start <= ' => $now, 'Sweepstakes.date_end >= ' => $now, 'Sweepstakes.active' => true, 'balance >' => 0])
            ->order(['Awards.id'])->toList();

        if ($awards_balance) {
            $award = null;

            $spaces = $awards_balance[0]->sweepstake->spaces;
            $difficulty = ($awards_balance[0]->sweepstake->difficulty == null) ? 5 : $awards_balance[0]->sweepstake->difficulty;
            
            $balance = count($awards_balance);
            if($balance > 0){
                $end = (int) ($balance * 100 / $difficulty);

                $selected = rand(1, $end);
                if ($selected <= $balance) {
                    $award = $awards_balance[$selected - 1]->id;
                }

                return $this->response->withStringBody(json_encode($award));
            }
            else{
                return $this->response->withStringBody("");
            }
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
                    return $this->response->withStringBody('-1');
                } else {
                    return $this->response->withStringBody('-1');
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
                            return $this->response->withStringBody("1");
                        } else {
                            return $this->response->withStringBody("-1");
                        }
                    }
                } else {
                    return $this->response->withStringBody("-1");
                }
            }
        } else {
            return $this->response->withStringBody("-1");
        }
    }
}
