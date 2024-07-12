<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Award Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $sweepstake_id
 * @property bool|null $active
 * @property int|null $quantity
 * @property int|null $balance
 * @property int|null $spaces
 * @property string|null $image
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Sweepstake $sweepstake
 * @property \App\Model\Entity\Play[] $play
 */
class Award extends Entity
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
        'name' => true,
        'description' => true,
        'sweepstake_id' => true,
        'active' => true,
        'quantity' => true,
        'balance' => true,
        'spaces' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
        'sweepstake' => true,
        'play' => true,
    ];
}
