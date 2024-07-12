<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sweepstakes Model
 *
 * @property \App\Model\Table\AwardsTable&\Cake\ORM\Association\HasMany $Awards
 *
 * @method \App\Model\Entity\Sweepstake newEmptyEntity()
 * @method \App\Model\Entity\Sweepstake newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sweepstake[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sweepstake get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sweepstake findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sweepstake patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sweepstake[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sweepstake|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sweepstake saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sweepstake[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sweepstake[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sweepstake[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sweepstake[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SweepstakesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('sweepstakes');
        $this->setDisplayField('description');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Awards', [
            'foreignKey' => 'sweepstake_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('description')
            ->maxLength('description', 100)
            ->allowEmptyString('description');

        $validator
            ->dateTime('date_start')
            ->allowEmptyDateTime('date_start');

        $validator
            ->dateTime('date_end')
            ->allowEmptyDateTime('date_end');

        $validator
            ->integer('spaces')
            ->allowEmptyString('spaces');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

        return $validator;
    }
}
