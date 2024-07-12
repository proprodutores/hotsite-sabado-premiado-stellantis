<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Awards Model
 *
 * @property \App\Model\Table\SweepstakesTable&\Cake\ORM\Association\BelongsTo $Sweepstakes
 * @property \App\Model\Table\PlayTable&\Cake\ORM\Association\HasMany $Play
 *
 * @method \App\Model\Entity\Award newEmptyEntity()
 * @method \App\Model\Entity\Award newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Award[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Award get($primaryKey, $options = [])
 * @method \App\Model\Entity\Award findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Award patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Award[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Award|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Award saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Award[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Award[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Award[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Award[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AwardsTable extends Table
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

        $this->setTable('awards');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sweepstakes', [
            'foreignKey' => 'sweepstake_id',
        ]);
        $this->hasMany('Play', [
            'foreignKey' => 'award_id',
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->allowEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 250)
            ->allowEmptyString('description');

        $validator
            ->integer('sweepstake_id')
            ->allowEmptyString('sweepstake_id');

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

        $validator
            ->integer('quantity')
            ->allowEmptyString('quantity');

        $validator
            ->integer('balance')
            ->allowEmptyString('balance');

        $validator
            ->integer('spaces')
            ->allowEmptyString('spaces');

        $validator
            ->scalar('image')
            ->maxLength('image', 250)
            ->allowEmptyFile('image');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('sweepstake_id', 'Sweepstakes'), ['errorField' => 'sweepstake_id']);

        return $rules;
    }
}
