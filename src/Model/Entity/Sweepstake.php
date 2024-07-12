<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sweepstake Entity
 *
 * @property int $id
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $date_start
 * @property \Cake\I18n\FrozenTime|null $date_end
 * @property int|null $spaces
 * @property bool|null $active
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Award[] $awards
 */
class Sweepstake extends Entity
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
        'description' => true,
        'date_start' => true,
        'date_end' => true,
        'spaces' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'awards' => true,
    ];
}
