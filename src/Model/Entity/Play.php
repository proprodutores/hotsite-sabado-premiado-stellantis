<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Play Entity
 *
 * @property int $id
 * @property string|null $drawn_position
 * @property int|null $award_id
 * @property int|null $user_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Award $award
 * @property \App\Model\Entity\User $user
 */
class Play extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'drawn_position' => true,
        'award_id' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'award' => true,
        'user' => true,
    ];
}
